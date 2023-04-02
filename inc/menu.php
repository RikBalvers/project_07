<?php

include 'check_login.php';
include_once 'db_conn.php';
$stmt = $pdo->prepare("SELECT `type` FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
$stmt->execute(['gebruikersnaam' => $_SESSION['gebruiker'], 'wachtwoord' => $_SESSION['wachtwoord']]);
$result = $stmt->fetch();

var_dump($result);
?>