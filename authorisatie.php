<?php

require_once("inc/db_conn.php");

session_start();

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

$secretKey = "6LfT_hslAAAAAAVS5M-DMUjvkYfeotiDEYRJTuuC";
$responseKey = $_POST['g-recaptcha-response'];
$userIP= $_SERVER['REMOTE_ADDR'];
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);

if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
} else {
    $stmt = $pdo->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($pwd, $user['wwhash']) && $response->success) {
        $_SESSION['uname'] = $uname;
        echo "<script>location.href='overzicht.php'</script>";
    } else {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
}
?>


<?php
require_once("inc/database.php");
include_once("inc/config.php");

session_start();

$inlognaam = $_POST['inlognaam'];
$wachtwoord = $_POST['wachtwoord'];

$secretKey = "6Lc5NV4lAAAAAAYDrC67gLi-U4i3S9AtAEXuTASB";
$responseKey = $_POST['g-recaptcha-response'];
$userIP= $_SERVER['REMOTE_ADDR'];
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);

if (isset($_SESSION['inlognaam'])) {
    echo "<script>location.href='hoornbeeck.php'</script>";
} else {
    $stmt = $dbconn->prepare("SELECT * FROM gebruiker WHERE inlognaam = :inlognaam");
    $stmt->bindParam(':inlognaam', $inlognaam);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($wachtwoord, $user['pwhash']) && $response->success) {
        $_SESSION['inlognaam'] = $inlognaam;
        echo "<script>location.href='overzicht.php'</script>";
    } else {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
}
?>