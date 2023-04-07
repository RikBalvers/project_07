<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Gedetineerd toevoegen</title>
</head>
<body>

<?php
    require_once("inc/db_conn.php");
    if (!isset($_SESSION['uname'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
?>

<?php 
include('inc/menu_klantenportaal.php')
?>

    <!-- Het 2e menu, de menu voor het personeel -->
    <div class="worker_menu">
        <div class="terug_blok">
            <a class="terug_knop" href="index.php">
                Terug naar klantenportaal
            </a>
        </div>
        <!-- Tijdelijke 2e menu voor het personeel -->
        <div class="menu_location">
            <?php include("inc/menu.php") ?>
        </div>
        <!-- uitloggen -->
        <div class="uitlog_blok">
            <a href="logout.php">Uitloggen</a>
        </div>
    </div>

    <div class="worker_content_toevoegen">
        <form  method="post"><br><h1>Toevoegen</h1><br>
            <label for="naam_gedetineerd">Naam gedetineerde*:</label><br>
            <input type="text" id="naam_gedetineerd" name="naam_gedetineerd"><br><br>
            <label for="geboortedatum_gedetineerd">Geboortedatum gedetineerd*:</label><br>
            <input type="date" id="geboortedatum_gedetineerd" name="geboortedatum_gedetineerd"><br><br>
            <label for="id_nummer">ID-nummer*:</label><br>
            <input type="number" id="id_nummer" name="id_nummer"><br><br>
            <label for="adres">Adres*:</label><br>
            <input type="text" id="adres" name="adres"><br><br>
            <label for="bezittingen">Bezittingen:</label><br>
            <input type="text" id="bezittingen" name="bezittingen"><br><br>
            <label for="opsluitingsdatum">Opsluitingsdatum*:</label><br>
            <input type="date" id="opsluitingsdatum" name="opsluitingsdatum"><br><br>
            <label for="vrijlatingsdatum">Vrijlatingsdatum*:</label><br>
            <input type="date" id="vrijlatingsdatum" name="vrijlatingsdatum"><br><br>
            <label for="locatie">Locatie vleugel & cel*:</label><br>
            <input type="text" id="locatie" name="locatie"><br><br>
            <label for="reden_gedetineerd">Reden gedetineerd*:</label><br>
            <input type="text" id="reden_gedetineerd" name="reden_gedetineerd"><br><br>
            <label for="opmerkingen">Extra opmerkingen:</label><br>
            <textarea id="opmerkingen" name="opmerkingen"></textarea><br><br><br>
            <input type="submit" name="submit" value="Toevoegen"><br><br>
        </form>
    </div>

<?php

if (isset($_POST['submit'])) {
    $naam = $_POST['naam_gedetineerd'];
    $geboortedatum = $_POST['geboortedatum_gedetineerd'];
    $id = $_POST['id_nummer'];
    $adres = $_POST['adres'];
    $bezittingen = $_POST['bezittingen'];
    $opsluit = $_POST['opsluitingsdatum'];
    $vrijlaten = $_POST['vrijlatingsdatum'];
    $locatie = $_POST['locatie'];
    $reden = $_POST['reden_gedetineerd'];
    $opmerking = $_POST['opmerkingen'];

    $sql = "INSERT INTO gedetineerd SET naam_gedetineerd = :naam_gedetineerd, geboortedatum_gedetineerd = :geboortedatum_gedetineerd, 	id_nummer = :id_nummer, 
    adres_gedetineerd = :adres_gedetineerd, bezittingen = :bezittingen, datum_opsluiting = :datum_opsluiting,
    datum_vrijlating = :datum_vrijlating, locatie_vleugel_cel = :locatie_vleugel_cel, reden_gedetineerd = :reden_gedetineerd, opmerkingen = :opmerkingen";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':naam_gedetineerd' => $naam,
        ':geboortedatum_gedetineerd' => $geboortedatum,
        ':id_nummer' => $id,
        ':adres_gedetineerd' => $adres,
        ':bezittingen' => $bezittingen,
        ':datum_opsluiting' => $opsluit,
        ':datum_vrijlating' => $vrijlaten,
        ':locatie_vleugel_cel' => $locatie,
        ':reden_gedetineerd' => $reden,
        ':opmerkingen' => $opmerking
    ]);

    header("location: overzicht.php");
    exit();
}

?>

</body>
</html>