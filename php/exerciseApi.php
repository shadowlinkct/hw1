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
    <script src="../javascript/exerciseApi.js" defer="true"></script>
    <link rel="stylesheet" href="../css/exerciseApi.css" />
    <title>hw1</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    ?>
    <div class="acchead">
        <h1>Esercizi</h1>

    </div>
    <form name='search_content' id='search_content'>

        <h1 id="h1API">Ricerca esercizi</h1>

        <label>Cerca per nome dell'esercizio: <input type='text' name='content' id='content'></label>

        <button class="submit" type="submit">CERCA</button>

    </form>

    <article id="exercise-view">

    </article>

    <?php
    require_once 'footer.php';
    ?>

</body>

</html>