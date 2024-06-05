<?php
session_start();
require_once "dbconnection.php";
if (!array_key_exists('id', $_SESSION)) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'header.php';
    ?>
    <link rel="stylesheet" href="../css/persistent.css">
    <script src="../javascript/sportMusic.js" defer="true"></script>
    <link rel="stylesheet" href="../css/sportMusic.css" />
    <title>hw1</title>
</head>

<body>
<?php
    require_once 'navbar.php';
    ?>
        <div class="acchead">
        <h1>SPOTIFY COLLAB</h1>

    </div>
    <div class="spotydivprincipale">
        <h1 class="spotydiv">ALLENATI CON LE NOSTRE HIT</h1>
        <div class="spotydiv">
            <label>Playlist:
                <select id="select_playlist"></select>
            </label>
        </div>
        <button id="btn_submit">CERCA</button>
        <div class="song-list" id="song-list"></div>
        <div id="song-detail"></div>
        <input type="hidden" id="hidden_token">
    </div>
    <div class="spotyimg">
        <img src="../img/spotycolab.png">
    </div>

    <?php
    require_once 'footer.php';
    ?>

</body>

</html>