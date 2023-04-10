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
    $uname = $_SESSION['uname'];
    $series = $pdo->query("SELECT * FROM gebruiker WHERE gebruikersnaam = '$uname'");
    $row = $series->fetch();
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

    <div class="worker_content_account">
        <form method="post">
            <h2><?php echo $row['naam_gebruiker'] ?></h2>
            <h1>Gegevens</h1><br>
            <table>
                <tr>
                    <th>Informatie</th>
                    <th class="gegevens">Gegevens</th>
                </tr>

                <tr>
                    <td>Gebruikersnaam</td>
                    <td class="gegevens"><input type="text" id="gebruikersnaam" name="gebruikersnaam" value="<?php echo $row['gebruikersnaam'] ?>"></td>
                </tr>

                <tr>
                    <td>Type account/rol</td>
                    <td class="gegevens"><?php echo $row['rol'] ?></td>
                </tr>

                <tr>
                    <td>Naam</td>
                    <td class="gegevens"><input type="text" id="naam_gebruiker" name="naam_gebruiker" value="<?php echo $row['naam_gebruiker'] ?>"?></td>
                </tr>

                <tr>
                    <td>E-mail</td>
                    <td class="gegevens"><input type="text" id="email_gebruiker" name="email_gebruiker" value="<?php echo $row['email_gebruiker'] ?>"?></td>
                </tr>

                <tr>
                    <td>Telefoon nummer</td>
                    <td class="gegevens">+31 <input type="number" id="telefoon_nr_gebruiker" name="telefoon_nr_gebruiker" value="<?php echo $row['telefoon_nr_gebruiker'] ?>"?></td>
                </tr>

                <tr>
                    <td>Opmerkingen</td>
                    <td class="gegevens"><textarea id="opmerkingen" name="opmerkingen"><?php echo $row['opmerkingen'] ?></textarea></td>
                </tr>

            </table>
            <br><br>
            <input type="submit" name="submit" value="Opslaan"><br><br>
            <input type="submit" name="terug" value="Terug">
        </form>
    </div>

<?php

if (isset($_POST['terug'])) {
    header("location: overzicht.php");
    exit();
}

if (isset($_POST['submit'])) {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $naam = $_POST['naam_gebruiker'];
    $email = $_POST['email_gebruiker'];
    $tel_nr = $_POST['telefoon_nr_gebruiker'];
    $opmerking = $_POST['opmerkingen'];

    $sql = "UPDATE gebruiker SET gebruikersnaam = :gebruikersnaam, naam_gebruiker = :naam_gebruiker, 
    email_gebruiker = :email_gebruiker, telefoon_nr_gebruiker = :telefoon_nr_gebruiker, opmerkingen = :opmerkingen WHERE gebruikersnaam = '$uname'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':gebruikersnaam' => $gebruikersnaam,
        ':naam_gebruiker' => $naam,
        ':email_gebruiker' => $email,
        ':telefoon_nr_gebruiker' => $tel_nr,
        ':opmerkingen' => $opmerking,
    ]);

    header("location: logout.php");
    exit();
}
?>

</body>
</html>