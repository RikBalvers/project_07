<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Contact</title>
</head>
<body>
<?php
require_once("inc/db_conn.php");
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
    $series = $pdo->query("SELECT * FROM gebruiker WHERE gebruikersnaam = '$uname'");
    $row = $series->fetch();
}
?>
    <!-- De banner foto -->
    <div class="banner">
        <img class="banner_img" src="images/contact_img.jpg">
    </div>

    <!-- Het menu -->
    <div class="menu">
        <a href="index.php"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a class="menu_text" href="index.php">Home</a>
        <a class="menu_text" href="over_ons.php">Over ons</a>
        <a id="active" class="menu_text" href="contact.php">Contact</a>
        <a class="menu_text" href="reserveren.php">Reserveren</a>
        <?php
        if (isset($_SESSION['uname'])) {
            echo "
            <div>
                <a href='account.php'>
                    <strong>Welkom " . $row['naam_gebruiker'] . "</strong>
                </a>
                <a href='login.php'>
                    <img class='account_login'src='images/account_icon.png' alt='account icon'>
                </a>
            </div>";
        } else {
            echo '<a href="login.php"><img class="account"src="images/account_icon.png" alt="account icon"></a>';
        }
        ?>
    </div>


    <!-- Dit is de titel van elk pagina -->
    <div class="hoofdtext">
        <p>Contact</p>
    </div>

    <!-- Dit is het blauwe stuk op het klantenportaal, hier kan je makkelijker doorverbinden naar een andere website naast de menu (is makkelijker) -->
    <div class="doorklik">
        <p>Een bezoekje geven kan altijd! &nbsp; <a href="reserveren.php">Reserveer nu!</a></p>
    </div>

    <!-- Dit is het content van de pagina, hier word alle info gegeven wat nodig is voor de klant -->
    <div class="content">
        <div class="content_content">
            <h1>Ons team en informatie</h1>
            <div class="content_text">
                <p>Ons team bestaat uit 4 rollen...</p><br>
                <p>De bewaker bestaat uit 5 medewerkers:</p>
                <?php
                $rol = "Bewaker";
                $sql = "SELECT * FROM gebruiker WHERE rol = :rol";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['rol' => $rol]);
                $gebruikers = $stmt->fetchAll();

                foreach($gebruikers as $gebruiker) {
                    echo "<li>" . $gebruiker['naam_gebruiker'] . ' &nbsp | &nbsp +31 ' . $gebruiker['telefoon_nr_gebruiker'] . ' &nbsp | &nbsp ' .  $gebruiker['email_gebruiker'] ."</li>";
                }
                ?><br>
                <p>De coordinator bestaat uit 3 medewerkers:</p>
                <?php
                $rol = "Coordinator";
                $stmt->execute(['rol' => $rol]);
                $gebruikers = $stmt->fetchAll();

                foreach($gebruikers as $gebruiker) {
                    echo "<li>" . $gebruiker['naam_gebruiker'] . ' &nbsp | &nbsp +31 ' . $gebruiker['telefoon_nr_gebruiker'] . ' &nbsp | &nbsp ' .  $gebruiker['email_gebruiker'] ."</li>";
                }
                ?><br>
                <p>De Administratie bestaat uit 3 groepen:</p>
                <li>Directeur &nbsp | &nbsp +31 699999999 &nbsp | &nbsp opp@hoornhack.nl</li>
                <li>Admin  &nbsp | &nbsp +31 28860578 &nbsp | &nbsp rikbalvers5@gmail.com</li>
                <li>Supervisors &nbsp | &nbsp +31 610260580 &nbsp | &nbsp ah@hoornbeeck.nl</li>
            </div>
        </div>
        <div class="content_pics">
            <h1>Contact opnemen</h1>
            <div class="form_content">
                <form action="inc/mail.php" method="POST">
                    <div class="contact_name_form">
                        <input type="email" name="klant_emial_contact" placeholder="E-mail">
                    </div>
                    <div class="contact_onderwerp_form">
                        <input type="text" name="klant_onderwerp_contact" placeholder="Onderwerp">
                    </div>
                    <div class="contact_omschrijving_form">
                        <textarea type="text" name="klant_omschrijving_contact" placeholder="Omschrijving"></textarea>
                    </div>
                    </br>
                    <div class="contact_submit_blok">
                        <input type="submit" name="send" value="Verstuur bericht">
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Dit is de footer van de pagina, hier word de laten zien wie het heeft gemaakt en logo van het bedrijf -->
<?php
include("inc/footer.php")
?>