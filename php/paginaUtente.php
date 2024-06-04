<?php
session_start();
require_once "dbconnection.php";
if (array_key_exists('id', $_SESSION)) {
    $query = "SELECT * FROM `account` WHERE id = '" . mysqli_real_escape_string($conn, $_SESSION['id']) . "'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);
        $nome = $row['nome'];
        $email = $row['email'];
    }
} else {

    header("Location: indexs.php");
}
?>
<!DOCTYPE html>

<head>
    <?php
    require_once 'header.php';
    ?>
    <link rel="stylesheet" href="../css/paginaUtente.css" />
    <link rel="stylesheet" href="../css/persistent.css">
    <script src="../javascript/paginaUtente.js" defer></script>
    <title>hw1</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    ?>
    <div class="acchead">
        <h1>Dettagli account</h1>

    </div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="#" data-content="dashboard"><i class="fas fa-tachometer-alt"></i> Bacheca</a></li>
                <li><a href="#" data-content="orders"><i class="fas fa-box"></i> Ordini</a></li>
                <li><a href="#" data-content="subscriptions"><i class="fas fa-sync-alt"></i> Abbonamenti</a></li>
                <li><a href="#" data-content="downloads"><i class="fas fa-download"></i> Download</a></li>
                <li><a href="#" data-content="tickets"><i class="fas fa-ticket-alt"></i> Tickets</a></li>
                <li><a href="#" data-content="coupons"><i class="fas fa-gift"></i> Coupon</a></li>
                <li><a href="#" data-content="addresses"><i class="fas fa-map-marker-alt"></i> Indirizzi</a></li>
                <li><a href="#" data-content="payment-methods"><i class="fas fa-credit-card"></i> Metodi di pagamento</a></li>
                <li><a href="#" data-content="affiliate"><i class="fas fa-user-friends"></i> Affiliazione</a></li>
                <li><a href="#" data-content="account-details" class="active"><i class="fas fa-user"></i> Dettagli account</a></li>
                <li><a href="#" data-content="billing-data"><i class="fas fa-file-invoice"></i> Dati fatturazione</a></li>
                <li><a href="#" data-content="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <div id="account-details" class="content-section active">
                <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome <span class="required">*</span></label>
                        <input type="text" id="nome" name="nome">
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome <span class="required">*</span></label>
                        <input type="text" id="cognome" name="cognome">
                    </div>
                </div>
                    <div class="form-group">
                        <label for="nome-visualizzato">Nome visualizzato <span class="required">*</span></label>
                        <?php echo "<input type='text' id='display-name' name='display-name' value='$nome'>" ?>
                        <small>Questo è il modo in cui il tuo nome verrà visualizzato nella sezione dell'account e nelle recensioni</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Indirizzo email <span class="required">*</span></label>
                        <?php echo "<input type='email' id='display-name' name='display-name' value='$email'>" ?>
                    </div>
                    <div class="form-group">
                        <h3>Modifica password</h3>
                    </div>
                    <div class="form-group">
                        <label for="current-password">Password attuale (lascia in bianco per non modificare)</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">Nuova password (lascia in bianco per non modificare)</label>
                        <input type="password" id="new-password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Conferma nuova password</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                    <button type="submit">SALVA LE MODIFICHE</button>
                </form>
            </div>
            <!--  -->
        </div>
    </div>
    <?php
    require_once 'footer.php';
    $conn->close();
    ?>
</body>

</html>