<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
</head>
<body>

<?php
require_once("inc/db_conn.php");
if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
}
?>

<?php include("inc/menu_klantenportaal.php") ?>


    <!-- Dit is het login gedeelte, hier word met de post methode en later in dit document word het verwerkt -->
    <div class="login_background">
        <div class="login_blok">
            <p>Inloggen op het Hekkensluiter systeem</p>
            <div class="login_blok2">
                <form action="authorisatie.php" method="POST">
                    <div class="login_text">
                        Inlognaam: <input type="text" name="uname">
                    </div>
                    <div class="login_text">
                        Wachtwoord: <input type="password" id="ww-login" name="pwd">
                        <i class="eye fa fa-solid fa-eye" id="togglePassword" style="color: #f67b50;"></i>
                    </div>
                    </br>
                    <div class="g-recaptcha" data-sitekey="6LfT_hslAAAAAHm2MXbg-mt_RES4-hrz9BwUGlU4"></div>
                    <div class="submit_blok">
                        <input type="submit" name="login" value="Inloggen">
                    </div>
                </form>
            </div>
        </div>

        <div class="sluiten_blok">
            <div class="sluiten_knop">
                <a href="index.php">
                    <i class="fa fa-thin fa-xmark" style="color: #4d4d4d; font-size: 18px;"></i> Sluiten
                </a>
            </div>
        </div>
    </div>

<!-- het oog bij wachtwoord door king julian -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#ww-login');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
</script>

</body>
</html>
