<?php
ob_start();
session_start();
require_once "dbconnection.php";
$error = "";
if (array_key_exists('id', $_SESSION)) {
    header("Location: index.php");
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
        $query = "SELECT * FROM `account` WHERE email = '" . mysqli_real_escape_string($conn, $_POST['email']) . "'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $error = "l'email inserita è già stata presa";
        } else if ($_POST['password'] != $_POST['conferma-password']) {
            $error = "Le password non corrispondono, Riprova!";
        } else {
            $password = $_POST['password'];
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO `account`(`nome`, `cognome`, `genere`, `data_n`, `email`, `password`, `tel_c`) VALUES ('" . $_POST['nome'] . "','" . $_POST['cognome'] . "','" . $_POST['genere'] . "','" . $_POST['data-di-nascita'] . "','" . $_POST['email'] . "','" . $hashed . "','" . $_POST['telefono'] . "')";
            if (!mysqli_query($conn, $query)) {
                $error = "<p>Ci sono stati degli errori del server. Riprovare più tardi.</p>";
            } else {
                $id = mysqli_insert_id($conn);
                $_SESSION['id'] =  $id;
                setcookie("id", $_SESSION['id'], time() + 3600);
                echo "Accesso avvenuto!!";
                header("Location: index.php");
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
    <title>Registrazione</title>
    <script src="../javascript/validazioneDatiReg.js" defer="true"></script>
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
    <div class="container">
        <form class="registration-form" method="post" action="">
            <h1>REGISTRAZIONE</h1>
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome <a href="#">*</a></label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cognome">Cognome <a href="#">*</a></label>
                    <input type="text" id="cognome" name="cognome" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="data-di-nascita">Data Di Nascita <a href="#">*</a></label>
                    <input type="date" id="data-di-nascita" name="data-di-nascita" required>
                </div>
                <div class="form-group">
                    <label for="genere">Genere</label>
                    <select id="genere" name="genere" required>
                        <option value="uomo">Uomo</option>
                        <option value="donna">Donna</option>
                        <option value="altro">Altro</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="telefono">Numero Di Telefono <a href="#">*</a></label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="email">Email <a href="#">*</a></label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password <a href="#">*</a></label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="conferma-password">Conferma Password <a href="#">*</a></label>
                    <input type="password" id="conferma-password" name="conferma-password" required>
                </div>
            </div>
            <button type="submit" name="submit">Registrati</button>
            <p>Sei già registrato? <a href="login.php">Accedi</a></p>
            <p>I tuoi dati personali verranno utilizzati per supportare la tua esperienza su questo sito Web, per gestire l'accesso al tuo account e per altri scopi descritti nella nostra <a>privacy policy.</a></p>
        </form>
    </div>
    <?php
    require_once 'footer.php';
    $conn->close();
    ?>
</body>

</html>