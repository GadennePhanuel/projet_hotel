<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/menu.css">

    <title>paiementEditBooking</title>
</head>
<body>
<div class="container">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">VotreHôtel.fr</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="menu.php">Retour au menu</a>
            </nav>
        </div>
    </header>

    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Recapitulatif de la nouvelle réservation</h1>
        </div>
    </div>

    <?php foreach ($_SESSION['roomModified'] as $content){ ?>
        <div class="row justify-content-center">
            <div class="col-12">
                <p>
                    <?php echo $content. "<br>"?>
                </p>
            </div>
        </div>
    <?php } ?>
    <div class="row justify-content-center newDateEditBooking">
        <div class="col-12">
            <p>
                <?php echo "Nouvelle date de réservation : ".$_SESSION['newDateStart']." - ".$_SESSION['newDateEnd'] .  "<br>"?>
            </p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <p>
                Prix total TTC : <?php echo $_SESSION['prixDiff']. "€" . "<br>"?>
            </p>
        </div>
    </div>
    <form action="../CTRL/paiementEditBooking2.action.php" method="post" class="formPaiementBooking">
        <p>
            <label for="mastercard">N° carte bancaire (16): </label>
            <input type="text" minlength="16" maxlength="16" name="mastercard" id="mastercard" required>
        </p>
        <?php
        if (isset($_SESSION["message"]) && !empty($_SESSION["message"])){
            foreach ($_SESSION["message"] as $value){
                ?>
                <div class="error_msg">
                    <?php        echo $value;   ?>
                </div>
                <?php
            }
            unset($_SESSION["message"]);
        }
        ?>
        <div class="row justify-content-center submitPaiementBooking">
                <input type="submit" class="btn btn-secondary btn-secondary2" value="Valider" />
        </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>