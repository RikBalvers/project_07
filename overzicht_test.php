<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start a session to store the user's information
session_start();

// If the user is not logged in, redirect back to the login page
if (!isset($_SESSION['user'])) {
    header('Location: login_test.php');
    exit;
}

// Get the user's information from the session
$user = $_SESSION['user'];

// Display the content of the page
echo "Welcome, {$user['gebruikersnaam']}! Here's the file.";
?>
