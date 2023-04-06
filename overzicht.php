<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Overzicht</title>
</head>
<body>

<?php
    require_once("inc/db_conn.php");
    if (!isset($_SESSION['uname'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
    $stmt = $pdo->prepare("SELECT rol FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->execute();
    $userRole = $stmt->fetchColumn();
?>

<?php
include("inc/menu_klantenportaal.php");
?>

    <!-- Het 2e menu, de menu voor het personeel -->
    <div class="worker_menu">
        <div class="terug_blok">
            <a class="terug_knop" href="index.php">
                Terug naar klantenportaal
            </a>
        </div>
        <!-- Tijdelijke 2e menu voor het personeel -->
        <div class="menu_location">
            <?php include("inc/menu.php") ?>
        </div>
        <!-- uitloggen -->
        <div class="uitlog_blok">
            <a href="logout.php">Uitloggen</a>
        </div>
    </div>

    <div class="worker_content">
        <table>
            <tr>
                <?php 
                switch($userRole) {
                    case 'Bewaker':
                        echo "  <th>Gedetineerde</th>
                                <th>Cel & vleugel</th>";
                    break;
                    default:
                        echo "  <th>Gedetineerde</th>
                                <th>Geboortedatum</th>
                                <th>ID-nummer</th>
                                <th>Adres</th>
                                <th>Bezittingen</th>
                                <th>Opsluiting</th>
                                <th>Vrijlating</th>
                                <th>Volgend bezoek</th>
                                <th>Bezoekers</th>
                                <th>Cel & vleugel</th>
                                <th>Historie cellen</th>
                                <th>Reden gedetineerd</th>
                                <th>Extra opmerking</th>
                                <th>Actie</th>";
                    break;
                }
                ?>
            </tr>
            <?php
            $sql="SELECT * FROM gedetineerd";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                switch($userRole) {
                    case 'Bewaker':
                        echo "<td>".$row['naam_gedetineerd']."</td>
                            <td>".$row['locatie_vleugel_cel']."</td>";
                    break;
                    case 'Coordinator':
                        echo "<td>".$row['naam_gedetineerd']."</td>
                            <td>".$row['geboortedatum_gedetineerd']."</td>
                            <td>".$row['id_nummer']."</td>
                            <td>".$row['adres_gedetineerd']."</td>
                            <td>".$row['bezittingen']."</td>
                            <td>".$row['datum_opsluiting']."</td>
                            <td>".$row['datum_vrijlating']."</td>
                            <td>".$row['datum_tijd_bezoek']."</td>
                            <td>".$row['aantal_bezoeken']."</td>
                            <td>".$row['locatie_vleugel_cel']." <a href='overplaatsen.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a></td>
                            <td>".$row['historie_locatie']."</td>
                            <td>".$row['reden_gedetineerd']."</td>
                            <td>".$row['opmerkingen']."</td>
                            <td>
                                <a href='verwijderen.php?id={$row['id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    default:
                        echo "<td>".$row['naam_gedetineerd']."</td>
                            <td>".$row['geboortedatum_gedetineerd']."</td>
                            <td>".$row['id_nummer']."</td>
                            <td>".$row['adres_gedetineerd']."</td>
                            <td>".$row['bezittingen']."</td>
                            <td>".$row['datum_opsluiting']."</td>
                            <td>".$row['datum_vrijlating']."</td>
                            <td>".$row['datum_tijd_bezoek']."</td>
                            <td>".$row['aantal_bezoeken']."</td>
                            <td>".$row['locatie_vleugel_cel']." <a href='overplaatsen.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a></td>
                            <td>".$row['historie_locatie']."</td>
                            <td>".$row['reden_gedetineerd']."</td>
                            <td>".$row['opmerkingen']."</td>
                            <td>
                                <a href='wijzigen.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='verwijderen.php?id={$row['id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>