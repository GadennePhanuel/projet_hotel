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

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/menu.css">

    <title>customerBooking</title>
</head>
<body class="text-center">
    <div class="container">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">VotreHôtel.fr</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="login.php">Retour au login</a>
                </nav>
            </div>
        </header>

        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Recapitulatif de la réservation</h1>
            </div>
        </div>

        <?php $customerRoom = $_SESSION['displayCustomerRoom'];
            foreach($customerRoom as $key => $value){?>
                <p> <?php echo $key. ' ' .$value. "<br>" ?></p>
            <?php } ?>



    </div>

    <footer>
        <p>Projet aout 2020 - PGA && MVI.</p>
    </footer>

</body>
</html>