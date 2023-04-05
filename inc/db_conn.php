<?php
$host = "localhost";
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

session_start();


// define('HOST', 'localhost');
// define('DATABASE', 'project_07');
// define('USER', 'root');
// define('PASSWORD', '');

// try {
//     $dbconn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
//     $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     throw new PDOException($e->getMessage(), (int)$e->getCode());
// }


?>