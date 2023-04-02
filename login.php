<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Login</title>
</head>
<body>

<?php
    session_start();

    $host = "127.0.0.1";
    $db = 'hekkensluiter_p07';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DRIVER_NAME => 'mysql',
    ];
    

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

?>

    <!-- Het menu -->
    <div class="menu">
        <a href="index.html"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a class="menu_text" href="index.html">Home</a>
        <a class="menu_text" href="over_ons.html">Over ons</a>
        <a class="menu_text" href="contact.html">Contact</a>
        <a class="menu_text" href="reserveren.html">Reserveren</a>
        <a href="login.php"><img class="account"src="images/account_icon.png" alt="account icon"></a>
    </div>

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
                        Wachtwoord: <input type="text" name="pwd">
                    </div>
                    </br>
                    <div class="submit_blok">
                        <input type="submit" name="login" value="Inloggen">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>



<!-- Username database: hoornhack -->
<!-- Password database: Wjg5l[-nn(QBbUqV -->

