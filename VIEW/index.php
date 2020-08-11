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
</head>

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">VotreHôtel.fr</h3>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">Utilisez notre appli web de gestion hôtelière !</h1>

            <p class="lead">Chargez votre fichier .csv contenant toutes les infos nécessaires à la gestion interne de votre hotel puis créer votre version personnalisée !</p>

            <p class="lead">
                <?php // il faut utiliser l'attribut `enctype="multipart/form-data"` pour que le fichier puisse être envoyé ?>
                <form action="../CTRL/index.action.php" method="post" enctype="multipart/form-data" >
                    <input name="fichier" type="file" />
                    <input type="submit" class="btn btn-secondary" value="Valider" />
                </form>
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
                unset ($_SESSION['hotel']);
            ?>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
            <p>Projet aout 2020 - PGA && MVI.</p>
            </div>
        </footer>
    </div>
</body>
</html>
