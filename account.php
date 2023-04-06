<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Account</title>
</head>
<body>

<?php
    require_once("inc/db_conn.php");
    if (!isset($_SESSION['uname'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
    $stmt = $pdo->prepare("SELECT rol FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->execute();
    $userRole = $stmt->fetchColumn();
?>

<?php
include("inc/menu_klantenportaal.php");
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

    <div class="worker_content">
    </div>
</body>
</html>