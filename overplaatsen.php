<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Wijzigen</title>
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

    <div class="worker_content_overplaatsen">
        <form method="POST">
            <br><h1>
                Overplaatsen van<br>
                <?php 
                $id = $_GET["id"];
                $series = $pdo->query("SELECT * FROM gedetineerd WHERE id = $id");
                $row = $series->fetch();
                echo $row['naam_gedetineerd']; 
                ?>
            </h1><br>
        <label for="toen_locatie">Oudere locaties:</label><br>
            <input type="text" id="toen_locatie" name="toen_locatie" value="<?php echo $row['historie_locatie'] ?>"><br><br>
            <label for="naar_locatie">Nieuwe locatie:</label><br>
            <input type="text" id="naar_locatie" name="naar_locatie" placeholder="Voorbeeld: A01, B14, C23"><br><br><br>
            <input type="submit" name="submit" value="Verander"><br><br>
        </form>
    </div>

<?php
if (isset($_POST['submit'])) {
    $toen = $_POST['toen_locatie'];
    $nieuw = $_POST['naar_locatie'];

    $sql = "UPDATE gedetineerd SET locatie_vleugel_cel = :locatie_vleugel_cel, historie_locatie = :historie_locatie WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if (empty($toen)) {
        $stmt->execute([
            ':locatie_vleugel_cel' => $nieuw,
            ':historie_locatie' => $toen . $nieuw,
            ':id' => $id
        ]);
    } else {
        $stmt->execute([
        ':locatie_vleugel_cel' => $nieuw,
        ':historie_locatie' => $toen . ', ' . $nieuw,
        ':id' => $id
    ]);
    }
}
?>

</body>
</html>