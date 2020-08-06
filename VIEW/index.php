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
</head>
<body>
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-8">
            <h1>Projet Hotel</h1>
        </div>
    </div>

        <?php // il faut utiliser l'attribut `enctype="multipart/form-data"` pour que le fichier puisse être envoyé ?>
    <form action="../CTRL/index.action.php" method="post" enctype="multipart/form-data" >
        <label for="fichier">fichier</label> <br />
        <input name="fichier" type="file" />
        <input type="submit" class="btn btn-success" value="envoyer" />
    </form>
</div>


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
</body>
</html>
