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
    <link rel="stylesheet" href="CSS/index.css">

    <title>passwordRevenue.php</title>
</head>

<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">VotreHôtel.fr</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link" href="menu.php">Retour au menu</a>
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Saisissez votre mot de passe</h1>
        <p class="lead">
        <form action="../CTRL/displayRevenue.action.php" method="post" class="form-example">
            <input type="password" name="password" id="password" placeholder="password" required>
            <input type="submit" class="btn btn-secondary" value="Valider" />
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
        <?php unset($_SESSION['password']);?>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>Projet aout 2020 - PGA && MVI.</p>
        </div>
    </footer>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
