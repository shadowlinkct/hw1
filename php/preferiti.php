<?php
session_start();
require_once "dbconnection.php";
if (!array_key_exists('id', $_SESSION)) {
    header("Location: login.php");
}
//echo "". $_SESSION["id"]."<br>"; //DEBUG
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'header.php';
    ?>
    <link rel="stylesheet" href="../css/preferiti.css" />
    <link rel="stylesheet" href="../css/persistent.css">
    <script src="../javascript/preferiti.js" defer></script>
    <script src="../javascript/esePreferiti.js" defer></script>
    <title>hw1</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    ?>
    <div class="acchead">
        <h1>Preferiti</h1>

    </div>
    <div class="tab-container">
        <div class="tab active" data-content="articoli-section">
        <div class='iconContainer'><img class='iconImgClass' src='../img/bookmark-svgrepo-com.svg'/><a>ARTICOLI</a> </div>
        </div>
        <div class="tab" data-content="esercizi-section">
        <div class='iconContainer'><img class='iconImgClass' src='../img/bodybuilding-fitness.svg'/><a>ESERCIZI PREFERITI</a> </div>
        </div>
    </div>
    <section class="multisection">
        <div id="articoli-section" class="content-section active">
            <div class="multisectioncontainer contenitore-articoli">
                <!-- Gli articoli verranno caricati qui dinamicamente -->
            </div>
        </div>
        <div id="esercizi-section" class="content-section">
            <div class="contenitore-esercizi"></div>
        </div>
    </section>

    <?php
    require_once 'footer.php';
    ?>
</body>

</html>