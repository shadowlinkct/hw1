<?php
ob_start();
session_start();
require_once "dbconnection.php";
$error = "";
if (array_key_exists('id', $_SESSION)) {
    header("Location: indexs.php");
}
if (array_key_exists("submit", $_POST)) {

    if (!$_POST['email']) {

        $error .= "Il campo email è obbligatorio<br>";
    }
    if (!$_POST['password']) {

        $error .= "Il campo password è obbligatorio<br>";
    }
    if ($error != "") {

        $error = "<p>Ci sono stati degli errori</p>" . $error;
    } else {


        // print_r($_POST);
        $query = "SELECT * FROM `account` WHERE email = '" . mysqli_real_escape_string($conn, $_POST['email']) . "'";

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($result);
        $userPassword = $_POST['password'];
        if ($row == false) {

            $error = "<p>Utente non trovato, Riprova!</p>" . $error;
        } else {
            $hashedPassword = $row['password'];
            /* if ($row["amministratore"] == true and password_verify($userPassword, $hashedPassword)) {
                $_SESSION['id'] = $row['id'];
                header("Location: webmaster.php");
            } else { */

            $hashedPassword = $row['password'];
            if (password_verify($userPassword, $hashedPassword)) {
                $_SESSION['id'] = $row['id'];
                setcookie("id", $row['id'], time() + 3600);
                if (isset($_POST['indexs']) && $_POST['indexs'] == '1') { /* Rimani connesso */

                    setcookie("id", $row['id'], time() + 3600);
                }
                echo "Accesso avvenuto!!";
                header("Location: indexs.php");
                // }
            }else{
                $error = "<p>La password non corrisponde, Riprova!</p>" . $error;
            }
        }
    }
    $_SESSION['emailsession'] = $_POST['email'];
}
if ($error != '') {
    echo '<div id="error">' . $error . '</div>';
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <?php
    require_once 'header.php';
    ?>
    <title>Login</title>
    <link rel="stylesheet" href="../css/registrazione.css">
    <link rel="stylesheet" href="../css/persistent.css">

</head>

<body>
    <?php
    require_once 'navbar.php';
    ?>
    <div class="acchead">
        <h1>Il mio account</h1>

    </div>
    <div class="logincontainer">
        <form class="registration-form" method="post" action="">
            <h1>LOGIN</h1>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email <a href="#">*</a></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password <a href="#">*</a></label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            <button type="submit" name="submit">Registrati</button>
            <p>Non hai un account? <a href="registrazione.php">Registrati</a></p>
            <p>I tuoi dati personali verranno utilizzati per supportare la tua esperienza su questo sito Web, per gestire l'accesso al tuo account e per altri scopi descritti nella nostra <a href="#">privacy policy.</a></p>
        </form>
    </div>
    <?php
    require_once 'footer.php';
    $conn->close();
    ?>
</body>

</html>