<?php

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


$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

session_start();

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$uname = "test";
$pwd = "test";

if (isset($_SESSION['uname'])) {
    echo "Hi welcome " . $_SESSION['uname'];
} else {
    $stmt = $pdo->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->bindParam(':wachtwoord', $pwd);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $_SESSION['uname'] = $uname;
        echo "<script>location.href='authorisatie.php'</script>";
    } else {
        echo "<script>alert('username or password incorrect!')</script>";
        echo "<script>location.href='login.php'</script>";
    }
}

?>

<?php
$host = '127.0.0.1';
$dbname = 'hekkensluiter_p07';
$username = 'root';
$password = '';

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

session_start();

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_SESSION['uname'])) {
      echo "Hi welcome " . $_SESSION['uname'];
  } else {
      $stmt = $conn->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
      $stmt->bindParam(':gebruikersnaam', $uname);
      $stmt->bindParam(':wachtwoord', $pwd);
      $stmt->execute();

      if($stmt->rowCount() == 1) {
          $_SESSION['uname'] = $uname;
          echo "<script>location.href='authorisatie.php'</script>";
      } else {
          echo "<script>alert('username or password incorrect!')</script>";
          echo "<script>location.href='login.php'</script>";
      }
  }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
