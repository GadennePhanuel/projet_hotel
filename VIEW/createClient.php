<?php
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
    <form action="../CTRL/createClientCheck.action.php" method="post" class="form-example">
        <div class="form-example">
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
        <p>
            <label for="clientSec">Souhaitez-vous créer un client secondaire (oui/non): </label>
            <input type="text" name="clientSec" id="clientSec" required>
        </p>

        <input type="submit" value="envoyer" />

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
</body>
</html>
