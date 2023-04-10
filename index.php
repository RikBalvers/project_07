<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Home</title>
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
        <img class="banner_img" src="images/home_img.jpg">
    </div>

    <!-- Het menu -->
    <div class="menu">
        <a href="index.php"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a id="active" class="menu_text" href="index.php">Home</a>
        <a class="menu_text" href="over_ons.php">Over ons</a>
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
        
    </div>


    <!-- Dit is de titel van elk pagina -->
    <div class="hoofdtext">
        <p>Zitten om te leren!</p>
    </div>

    <!-- Dit is het blauwe stuk op het klantenportaal, hier kan je makkelijker doorverbinden naar een andere website naast de menu (is makkelijker) -->
    <div class="doorklik">
        <p>Een bezoekje maken bij deze gevangenis? &nbsp; <a href="reserveren.php">Reserveer hier!</a></p>
    </div>

    <!-- Dit is het content van de pagina, hier word alle info gegeven wat nodig is voor de klant -->
    <div class="content">
        <div class="content_content">
            <h1>Welkom op onze website!</h1>
            <div class="content_text">
                <p>
                    Wij bieden niet alleen informatie over het gevangenisleven, maar ook een kijkje in het cellencomplex.
                    Wij geven u graag meer informatie over hoe de cellen zijn ingericht en hoe het dagelijks leven eruitziet voor de gedetineerden.
                </p>
                <br>
                <p>
                    Daarnaast kunt u op onze website meer lezen over wie wij zijn en wat wij doen. 
                    Bij de over ons pagina vindt u meer informatie over ons team en onze missie om mensen bewust te maken van het gevangenisleven en het belang van rehabilitatie en re-integratie.
                </p>
            </div>
        </div>
        <div class="content_pics">
            <img src="images/home__context_pic.jpg">
        </div>
    </div>

<!-- Dit is de footer van de pagina, hier word de laten zien wie het heeft gemaakt en logo van het bedrijf -->
<?php
include("inc/footer.php")
?>