<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	// Start a session to store the user's information
	session_start();

	// If the user is already logged in, redirect to the file page
	if (isset($_SESSION['gebruiker'])) {
	    header('Location: overzicht_test.php');
	    exit;
	}

	// If the form has been submitted, attempt to log the user in
	if (isset($_POST['login'])) {
	    // Get the user's credentials from the form submission
	    $username = $_POST['gebruikersnaam'];
	    $password = $_POST['wachtwoord'];

	    // Connect to the database using PDO
	    require_once "inc/db_conn.php";

	    // Prepare a SELECT statement to check if the user exists
	    $stmt = $pdo->prepare('SELECT * FROM gebruiker WHERE gebruikersnaam = ?');
	    $stmt->execute([$username]);
	    $user = $stmt->fetch();

	    // If the user doesn't exist, show an error message
	    if (!$user) {
	        echo "Invalid username or password.";
	    } else {
	        // If the user exists, check if the password is correct
	        if (password_verify($password, $user['wachtwoord'])) {
	            // If the password is correct, store the user's information in the session and redirect to the file page
	            $_SESSION['gebruiker'] = $user;
	            header('Location: overzicht_test.php');
	            exit;
	        } else {
	            // If the password is incorrect, show an error message
	            echo "Invalid username or password.";
	        }
	    }
	}
	?>
	<form method="POST" action="login_test.php">
		<label>Username:</label>
		<input type="text" name="gebruikersnaam"><br><br>
		<label>Password:</label>
		<input type="password" name="wachtwoord"><br><br>
		<input type="submit" name="login" value="Login">
	</form>
</body>
</html>
