<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Retrieve form data
$klant_email = $_POST['klant_emial_contact'];
$klant_onderwerp = $_POST['klant_onderwerp_contact'];
$klant_omschrijving = $_POST['klant_omschrijving_contact'];

// Create a PHPMailer instance
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'mail.45759.hbcdeveloper.nl'; // Set the SMTP server to your hosting provider's SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'h45759'; // Your email address
    $mail->Password   = 'hGbF28mZWfwPytS'; // Your email account password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; // The SMTP port used by your hosting provider

    //Recipients
    $mail->setFrom($klant_email, 'Sender Name'); // The sender's email address and name
    $mail->addAddress('rikbalvers@outlook.com', 'Rik'); // The recipient's email address and name

    // Content
    $mail->isHTML(true);
    $mail->Subject = $klant_onderwerp;
    $mail->Body    = $klant_omschrijving;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "'Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br><br>";
    echo "<p style='color:red;'>Deze actie is nog incompleet vanwege te kort aan informatie</p>";
    echo "<strong>U wordt terug gestuurd...</strong>";
    header("refresh: 2, url=../contact.php");
}
?>
