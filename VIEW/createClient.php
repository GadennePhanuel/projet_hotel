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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>createClient</title>
</head>
<body>
    <h2>Module de création client</h2>
    <form action="../CTRL/createClientCheck.action.php" method="post" >
        <div >
            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <p>
            <label for="prenom">Prenom: </label>
            <input type="text" name="prenom" id="prenom" required>
        </p>
        <p>
            <label for="age">Age: </label>
            <input type="text" name="age" id="age" required>
        </p>
        <p>
            <label for="login">Login: </label>
            <input type="text" name="login" id="login" required>
        </p>
        <p>
            <label for="email">Mail: </label>
            <input type="text" name="email" id="email" required>
        </p>
        <p>
            <label for="mastercard">Carte bancaire: </label>
            <input type="text" name="mastercard" id="mastercard" required>
        </p>
    <br>

        <div>
            <p>
                <label for="nomSec">Nom: </label>
                <input type="text" name="nomSec" id="nomSec" >
            </p>
            <p>
                <label for="prenomSec">Prenom:  </label>
                <input type="text" name="prenomSec" id="prenomSec" >
            </p>
            <p>
                <label for="ageSec">Age: </label>
                <input type="text" name="ageSec" id="ageSec" >
            </p>
        </div>

    <br>


        <div>
            <p>
                <label for="nomSec2">Nom: </label>
                <input type="text" name="nomSec2" id="nomSec2" >
            </p>
            <p>
                <label for="prenomSec2">Prenom: </label>
                <input type="text" name="prenomSec2" id="prenomSec2" >
            </p>
            <p>
                <label for="ageSec2">Age: </label>
                <input type="text" name="ageSec2" id="ageSec2" >
            </p>
        </div>

    <br>
        <div>

            <p>
                <label for="nomSec3">Nom: </label>
                <input type="text" name="nomSec3" id="nomSec3" >
            </p>
            <p>
                <label for="prenomSec3">Prenom: </label>
                <input type="text" name="prenomSec3" id="prenomSec3" >
            </p>
            <p>
                <label for="ageSec3">Age: </label>
                <input type="text" name="ageSec3" id="ageSec3" >
            </p>
        </div>
        <input type="submit" value="envoyer" />
    </form>
    <div class="row justify-content-center">
        <div class="col-3">
            <a href="menu.php">Retour au menu</a>
        </div>
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
        unset($_SESSION['customer'])
        ?>
</body>
</html>
