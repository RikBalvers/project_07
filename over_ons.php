<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Over ons</title>
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
        <img class="banner_img" src="images/over_ons_img.jpg">
    </div>

    <!-- Het menu -->
    <div class="menu">
        <a href="index.php"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a class="menu_text" href="index.php">Home</a>
        <a id="active" class="menu_text" href="over_ons.php">Over ons</a>
        <a class="menu_text" href="contact.php">Contact</a>
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
        <p>Over ons</p>
    </div>

    <!-- Dit is het blauwe stuk op het klantenportaal, hier kan je makkelijker doorverbinden naar een andere website naast de menu (is makkelijker) -->
    <div class="doorklik">
        <p>Meer over ons weten? &nbsp; <a href="contact.php">Neem gerust contact op!</a></p>
    </div>

    <!-- Dit is het content van de pagina, hier word alle info gegeven wat nodig is voor de klant -->
    <div class="content">
        <div class="content_content">
            <h1>Wil je weten hoe wij werken?</h1>
            <div class="content_text">
                <p>
                    Ons cellencomplex bestaat uit 23 cellen en 3 vleugels, vleugel A B & C. Elk vleugel is verschillend. In vleugel A zit je voor tot en met 5 jaar vast, in vleugel B zit je voor tot en met 10 jaar vast en bij vleugel C zit je van 10 tot levenslang. Verplaatsen van cellen kan wanneer er onderzoek is gedaan en er uitspraak is gekomen van de rechter...
                </p>
                <br>
                <p>
                    Ons team bestaat uit 9 medewerkers inclusief directeur; 5 bewakers, 3 coordinators en directeur Opperhek. Om meer informatie hiervan te lezen en contact op te nemen kunt u naar onze contact pagina gaan.
                </p>
            </div>
        </div>
        <div class="content_pics">
            <img src="images/over_ons_content_img.png">
        </div>
    </div>

<!-- Dit is de footer van de pagina, hier word de laten zien wie het heeft gemaakt en logo van het bedrijf -->
<?php
include("inc/footer.php")
?>