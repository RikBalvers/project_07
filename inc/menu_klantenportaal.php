<!-- Het menu -->

<?php
require_once("inc/db_conn.php");
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
    $series = $pdo->query("SELECT * FROM gebruiker WHERE gebruikersnaam = '$uname'");
    $row = $series->fetch();
}
?>
    <div class="menu">
        <a href="index.php"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a class="menu_text" href="index.php">Home</a>
        <a class="menu_text" href="over_ons.php">Over ons</a>
        <a class="menu_text" href="contact.php">Contact</a>
        <a class="menu_text" href="reserveren.php">Reserveren</a>
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
