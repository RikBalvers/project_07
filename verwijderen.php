<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Overzicht</title>
</head>
<body>

<?php
    require_once("inc/db_conn.php");
    if (!isset($_SESSION['uname'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
    $sql="SELECT * FROM gedetineerd";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <div class="worker_content_verwijderen">
        <form method="POST">
            <h1>Vrijlaten/Verwijderen gedetineerde</h1>
            <h2>
                <?php 
                $id = $_GET["id"];
                $series = $pdo->query("SELECT * FROM gedetineerd WHERE id = $id");
                $row = $series->fetch();
                echo $row['naam_gedetineerd'];
                ?>
            </h2><br><strong style="color:red;">Wilt u zeker deze gedetineerde verwijderen uit het overzicht?</strong><br><br>
            <input type="submit" name="verwijderen" id="verwijderen" value="Verwijderen"><br>
            <input type="submit" name="terug" id="terug" value="Terug"><br>
        </form>
    </div>

<?php
if(isset($_POST['terug'])) {
    echo "<script>location.href='overzicht.php'</script>";
    header("Location: overzicht.php");
    exit();
}

elseif(isset($_POST['verwijderen'])) {
    $sql = "DELETE FROM gedetineerd WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: overzicht.php");
    exit();
}
?>

</body>
</html>