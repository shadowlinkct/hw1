<?php
session_start();
require_once 'dbconnection.php';

header("Content-Type: application/json");

$metodoRichiesta = $_SERVER["REQUEST_METHOD"];

switch ($metodoRichiesta) {
    case 'GET':
        if (isset($_GET['preferiti'])) {
            if (isset($_SESSION["id"])) {
                gestisciGetPreferiti();
            } else {
                http_response_code(401); 
                echo json_encode(["errore" => "Utente non loggato"]);
            }
        } else {
            gestisciGet();
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

function gestisciGet()
{
    global $conn;
    $sql = "SELECT * FROM articoli";
    $risultato = mysqli_query($conn, $sql);
    $articoli = [];
    while ($riga = mysqli_fetch_assoc($risultato)) {
        $articoli[] = $riga;
    }
    echo json_encode($articoli);
}

function gestisciGetPreferiti()
{
    global $conn;
    $id_utente = $_SESSION["id"];
    $sql = "SELECT a.* FROM preferiti p INNER JOIN articoli a ON p.id_articolo = a.id WHERE p.id_utente = '$id_utente'";
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
    if (isset($input['id_articolo'])) {
        $id_articolo = mysqli_real_escape_string($conn, $input['id_articolo']);

        $sql = "INSERT INTO preferiti (id_utente, id_articolo) VALUES ('$id_utente', '$id_articolo')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["messaggio" => "Articolo aggiunto ai preferiti"]);
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
    if (isset($input['id_articolo'])) {
        $id_articolo = mysqli_real_escape_string($conn, $input['id_articolo']);

        $sql = "DELETE FROM preferiti WHERE id_utente = '$id_utente' AND id_articolo = '$id_articolo'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["messaggio" => "Articolo rimosso dai preferiti"]);
        } else {
            echo json_encode(["errore" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["errore" => "Dati di input non validi"]);
    }
}
