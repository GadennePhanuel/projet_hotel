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
    <title>login</title>
</head>
<body>

<form action="../CTRL/login.action.php" method="post" class="form-example">
    <div class="form-example">
        <label for="login">Saisissez votre login: </label>
        <input type="text" name="login" id="login" required>
        <input type="submit" value="envoyer" />
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

    ?>
    <?php unset($_SESSION['displayCustomerRoom']);?>
</body>


</html>