<?php
session_start();

if (empty($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit();
}

?>
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
    $host = "127.0.0.1";
    $db = 'hekkensluiter_p07';
    $user = 'hoornhack';
    $pass = 'Wjg5l[-nn(QBbUqV';
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
        <a href="account.php"><img class="account"src="images/account_icon.png" alt="account icon"></a>
    </div>

    <!-- Het 2e menu, de menu voor het personeel -->
    <div class="worker_menu">
        <div class="terug_blok">
            <button class="terug_knop" href="index.html">
                Terug naar klantenportaal
            </button>
        </div>
        <!-- Tijdelijke 2e menu voor het personeel -->
        <div class="menu_location">
            <a href="#">Overzicht</a>
            <a href="#">Overplaatsen</a>
            <a href="#">In cel zetten</a>
            <a href="#">Gegevens aanpassen</a>
            <a href="#">Over mijn account</a>
        </div>
        <!-- uitloggen -->
        <div class="uitlog_blok">
            <button href="logout.php">Uitloggen</button>
        </div>
    </div>

<?php
    // session_destroy();
?>
</body>
</html>