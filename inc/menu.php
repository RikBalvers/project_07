<?php
require_once("db_conn.php");
// Get the user's role from a database or session variable
$uname = $_SESSION['uname'];
$stmt = $pdo->prepare("SELECT rol FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam");
$stmt->bindParam(':gebruikersnaam', $uname);
$stmt->execute();
$userRole = $stmt->fetchColumn();

// Set the menu options based on the user's role
switch ($userRole) {
    case "Admin":
        $menu = '
                <a href="./overzicht.php">Overzicht</a>
                <a href="./toevoegen.php">Gedetineerde toevoegen</a>
                <a href="./bezoek.php">Bezoek overzicht</a>
                <a href="./account.php">Over mijn account</a>';
        break;
    case "Directeur":
        $menu = '
                <a href="./overzicht.php">Overzicht</a>
                <a href="./toevoegen.php">Gedetineerde toevoegen</a>
                <a href="./bezoek.php">Bezoek overzicht</a>
                <a href="./account.php">Over mijn account</a>';
        break;
    case "Bewaker":
        $menu = '
                <a href="./overzicht.php">Overzicht</a>
                <a href="./toevoegen.php">Gedetineerde toevoegen</a>
                <a href="./account.php">Over mijn account</a>';
        break;
    case "Coordinator":
        $menu = '
                <a href="./overzicht.php">Overzicht</a>
                <a href="./toevoegen.php">Gedetineerde toevoegen</a>
                <a href="./bezoek.php">Bezoek overzicht</a>
                <a href="./account.php">Over mijn account</a>';
        break;
    case "Supervisor":
        $menu = '
                <a href="./overzicht.php">Overzicht</a>
                <a href="./toevoegen.php">Gedetineerde toevoegen</a>
                <a href="./bezoek.php">Bezoek overzicht</a>
                <a href="./account.php">Over mijn account</a>';
        break;
    default:
        $menu = 'Er gaat iets mis hier'; // Set an empty menu if the user role is unknown
}

echo $menu; // Output the menu
?>
