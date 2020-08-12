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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/menu.css">
    <title>createClient.php</title>
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
            <h1>Module de création client</h1>
        </div>
    </div>

    <form action="../CTRL/createClientCheck.action.php" method="post" class="formCreateClient">
      <div class="formClientPrincipal">
          <h4>Client Principal</h4>
          <label for="nom">Nom: </label>
          <input type="text" name="nom" id="nom" required>
          <label for="prenom">Prenom: </label>
          <input type="text" name="prenom" id="prenom" required>
          <label for="age">Age: </label>
          <input type="text" name="age" id="age" required>
          <label for="login">Login: </label>
          <input type="text" name="login" id="login" required>
          <label for="email">Mail: </label>
          <input type="text" name="email" id="email" required>
      </div>

      <div>
          <h4>Clients Secondaires</h4>
          <div class="formClientsSecondaires">
              <div class="formClient">
                  <label for="nomSec">Nom: </label>
                  <input type="text" name="nomSec" id="nomSec" >
                  <label for="prenomSec">Prenom:  </label>
                  <input type="text" name="prenomSec" id="prenomSec" >
                  <label for="ageSec">Age: </label>
                  <input type="text" name="ageSec" id="ageSec" >

              </div>

              <div class="formClient">
                  <label for="nomSec2">Nom: </label>
                  <input type="text" name="nomSec2" id="nomSec2" >
                  <label for="prenomSec2">Prenom: </label>
                  <input type="text" name="prenomSec2" id="prenomSec2" >
                  <label for="ageSec2">Age: </label>
                  <input type="text" name="ageSec2" id="ageSec2" >

              </div>

              <div class="formClient">
                  <label for="nomSec3">Nom: </label>
                  <input type="text" name="nomSec3" id="nomSec3" >
                  <label for="prenomSec3">Prenom: </label>
                  <input type="text" name="prenomSec3" id="prenomSec3" >
                  <label for="ageSec3">Age: </label>
                  <input type="text" name="ageSec3" id="ageSec3" >
              </div>
          </div>
      </div>

      <div class="row justify-content-center submitCreateClient">
          <input type="submit" class="btn btn-secondary btn-secondary2" value="Valider" />
      </div>
    </form>

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
        unset($_SESSION['customer'])
        ?>

        <footer>
            <p>Projet aout 2020 - PGA && MVI.</p>
        </footer>
</div>

</body>
</html>
