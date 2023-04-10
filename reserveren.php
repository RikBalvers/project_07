<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Reserveren</title>
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
        <img class="banner_img" src="images/reserveren_img.png">
    </div>

    <!-- Het menu -->
    <div class="menu">
        <a href="index.php"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a class="menu_text" href="index.php">Home</a>
        <a class="menu_text" href="over_ons.php">Over ons</a>
        <a class="menu_text" href="contact.php">Contact</a>
        <a id="active" class="menu_text" href="reserveren.php">Reserveren</a>
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
        <p>Reserveren</p>
    </div>

    <!-- Dit is het blauwe stuk op het klantenportaal, hier kan je makkelijker doorverbinden naar een andere website naast de menu (is makkelijker) -->
    <div class="doorklik">
        <p>Heb je vragen? &nbsp; <a href="contact.php">Neem gerust contact op!</a></p>
    </div>

    <!-- Dit is het content van de pagina, hier word alle info gegeven wat nodig is voor de klant -->
    <div class="content">
        <div class="content_content">
            <h1>Onze reservering & <br>openingstijden</h1>
            <div class="content_text">
                <table>
                    <tr>
                        <th>Dag</th>
                        <th>Tijd</th>
                    </tr>
                    <tr>
                        <td>Maandag</td>
                        <td>10.00 - 15.00</td>
                    </tr>
                    <tr>
                        <td>Dinsdag</td>
                        <td>11.00 - 16.00</td>
                    </tr>
                    <tr>
                        <td>Woensdag</td>
                        <td>10.00 - 15.00</td>
                    </tr>
                    <tr>
                        <td>Donderdag</td>
                        <td>10.00 - 16.00</td>
                    </tr>
                    <tr>
                        <td>Vrijdag</td>
                        <td>12.00 - 17.00</td>
                    </tr>
                    <tr>
                        <td>Zaterdag</td>
                        <td>13.00 - 15.00</td>
                    </tr>
                    <tr>
                        <td>Zondag</td>
                        <td>Dicht</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="content_pics">
            <h1>Reserveren</h1>
            <div class="form_reserveren">
                <form method="POST">
                    <?php
                        if (isset($_POST['request'])) {
                            echo "Verzoek verstuurd";
                        }
                    ?>
                    <div class="reserveren_form_info">
                        Naam
                        <input type="text" name="klant_naam_bezoeker_reserveren" placeholder="Uw volledige naam">
                        Naam gedetineerde
                        <input type="text" name="klant_naam_gevangene_reserveren" placeholder="Naam van gedetineerde">
                        <div class="form_reserveren_optional">
                            Geboortedatum gedetineerde
                            <input type="date" name="klant_geboortedatum_gevangene_reserveren">
                        </div>
                        <div class="form_reserveren_vervolg">
                            Datum & tijd bezoeken
                            <input type="datetime-local" name="klant_tijd_bezoeken_reserveren">
                            Relatie met gedetineerde
                            <select name="relatie_met_gedetineerde" id="relatie_met_gedetineerde">
                                <option value="NULL">--</option>
                                <option value="Familie">Familie</option>
                                <option value="Vriendelijk">Vriendelijk</option>
                                <option value="Liefdesrelatie">Liefdesrelatie</option>
                                <option value="Anders">Anders</option>
                            </select><br>
                            Email
                            <input type="email" name="klant_email_reserveren" placeholder="uw e-mail">
                            Telefoon nummer
                            <input type="tel" name="klant_tel_nr_reserveren" placeholder="Uw telefoon nummer">
                            Straat en huisnummer
                            <input type="text" name="klant_adres_reserveren" placeholder="Uw straat en huisnummer">
                            Postcode en woonplaats
                            <input type="text" name="klant_postocde_woonplaats_reserveren" placeholder="Uw postcode en woonplaats">
                            Opmerkingen (extra)
                            <textarea name="reserveren_opmerking_form" placeholder="Opmerkingen"></textarea>
                            </br><br>
                            <div class="reserveren_submit_blok">
                                <input type="submit" name="request" value="Verstuur Reservering">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['request'])) {

        $naam_bezoeker = $_POST['klant_naam_bezoeker_reserveren'];
        $naam_gedetineerde = $_POST['klant_naam_gevangene_reserveren'];
        $geboortedatum_gedetineerde = $_POST['klant_geboortedatum_gevangene_reserveren'];
        $datetime_bezoeken = $_POST['klant_tijd_bezoeken_reserveren'];
        $relatie_gedetineerd = $_POST['relatie_met_gedetineerde'];
        $email_bezoeker = $_POST['klant_email_reserveren'];
        $tel_bezoeker = $_POST['klant_tel_nr_reserveren'];
        $strt_huisnr = $_POST['klant_adres_reserveren'];
        $postcode_woonplaats = $_POST['klant_postocde_woonplaats_reserveren'];
        $opmerkingen = $_POST['reserveren_opmerking_form'];

        $sql = "INSERT INTO bezoekafspraak SET naam_bezoeker = :naam_bezoeker, naam_gevangene = :naam_gevangene, geboortedatum_gevangene = :geboortedatum_gevangene, datum_tijd_bezoek = :datum_tijd_bezoek, relatie_met_gevangene = :relatie_met_gevangene, email_bezoeker = :email_bezoeker, telefoon_nr_bezoeker = :telefoon_nr_bezoeker, adres_bezoeker = :adres_bezoeker, postcode_woonplaats_bezoeker	 = :postcode_woonplaats_bezoeker, opmerkingen = :opmerkingen";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam_bezoeker' => $naam_bezoeker,
            ':naam_gevangene' => $naam_gedetineerde,
            ':geboortedatum_gevangene' => $geboortedatum_gedetineerde,
            ':datum_tijd_bezoek' => $datetime_bezoeken,
            ':relatie_met_gevangene' => $relatie_gedetineerd,
            ':email_bezoeker' => $email_bezoeker,
            ':telefoon_nr_bezoeker' => $tel_bezoeker,
            ':adres_bezoeker' => $strt_huisnr,
            ':postcode_woonplaats_bezoeker' => $postcode_woonplaats,
            ':opmerkingen' => $opmerkingen
        ]);
    }
    ?>

<!-- Dit is de footer van de pagina, hier word de laten zien wie het heeft gemaakt en logo van het bedrijf -->
<?php
include("inc/footer.php")
?>