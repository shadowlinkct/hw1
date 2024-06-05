<?php
session_start();
require_once 'dbconnection.php';

header("Content-Type: application/json");

$metodoRichiesta = $_SERVER["REQUEST_METHOD"];

switch ($metodoRichiesta) {
    case 'GET':
        if (isset($_GET['preferiti'])) {
            if (isset($_SESSION["id"])) {
                gestisciGetPreferitiEsercizi();
            } else {
                http_response_code(401); 
                echo json_encode(["errore" => "Utente non loggato"]);
            }
        } else {
            gestisciGetEsercizi();
        }
        break;
    case 'POST':
    case 'DELETE':
        if (!isset($_SESSION["id"])) {
            http_response_code(401); 
            echo json_encode(["errore" => "Utente non loggato"]);
            exit;
        }
        if ($metodoRichiesta == 'POST') {
            gestisciPost();
        } elseif ($metodoRichiesta == 'DELETE') {
            gestisciDelete();
        }
        break;
    default:
        echo json_encode(["messaggio" => "Metodo non supportato"]);
        break;
}

function gestisciGetEsercizi()
{
    global $conn;
    $sql = "SELECT * FROM esercizi";
    $risultato = mysqli_query($conn, $sql);
    $esercizi = [];
    while ($riga = mysqli_fetch_assoc($risultato)) {
        $esercizi[] = $riga;
    }
    echo json_encode($esercizi);
}

function gestisciGetPreferitiEsercizi()
{
    global $conn;
    $id_utente = $_SESSION["id"];
    $sql = "SELECT e.* FROM esercizipreferiti p INNER JOIN esercizi e ON p.id_esercizio = e.id WHERE p.id_utente = '$id_utente'";
    $risultato = mysqli_query($conn, $sql);
    $preferiti = [];
    while ($riga = mysqli_fetch_assoc($risultato)) {
        $preferiti[] = $riga;
    }
    echo json_encode($preferiti);
}

function gestisciPost()
{
    global $conn;
    $id_utente = $_SESSION["id"];
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['name']) && isset($input['description']) && isset($input['image'])) {
        $name = mysqli_real_escape_string($conn, $input['name']);
        $description = mysqli_real_escape_string($conn, $input['description']);
        $image = mysqli_real_escape_string($conn, $input['image']);
    
       
        $sql_esercizio = "INSERT INTO esercizi (nome, immagine, descrizione) VALUES ('$name', '$image', '$description')";
        if (mysqli_query($conn, $sql_esercizio)) {
            $id_esercizio= mysqli_insert_id($conn);
            error_log("id_esercizio: " . $id_esercizio);
         
            $sql_preferiti = "INSERT INTO esercizipreferiti (id_utente, id_esercizio) VALUES ('$id_utente', '$id_esercizio')";
            if (mysqli_query($conn, $sql_preferiti)) {
                echo json_encode(["messaggio" => "Esercizio aggiunto ai preferiti"]);
            } else {
                echo json_encode(["errore" => mysqli_error($conn)]);
            }
        } else {
            echo json_encode(["errore" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["errore" => "Dati di input non validi"]);
    }
}


function gestisciDelete()
{
    global $conn;
    $id_utente = $_SESSION["id"];
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['id_esercizio'])) {
        $id_esercizio = mysqli_real_escape_string($conn, $input['id_esercizio']);

        $sql = "DELETE FROM esercizipreferiti WHERE id_utente = '$id_utente' AND id_esercizio = '$id_esercizio'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["messaggio" => "Esercizio rimosso dai preferiti"]);
        } else {
            echo json_encode(["errore" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["errore" => "Dati di input non validi"]);
    }
}
