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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php $displayRoomType = $_SESSION['displayRoomType'];
    foreach($displayRoomType as $type){?>
        <div>
            <?php $list = $type;
            foreach ($list as $key => $value){?>
                <p><?php echo $key. ' ' .$value. "<br>" ?></p>
            <?php } ?>
        </div>
        <br>
   <?php } ?>
    <form action="../CTRL/bookingRoom.action.php" method="post" class="form-example">
        <div class="form-example">
            <label for="type">Saisissez le type de chambre souhaitée (1 à 8) </label>
            <input type="text" name="type" id="type" required>

        </div>
        <div class="form-example">
            <label for="dateStart">Start date:</label>

            <input type="date" id="dateStart" name="dateStart"
                   value="0000-00-00"
                   min="2020-09-01" max="2023-01-01">
        </div>
        <div class="form-example">
            <label for="dateEnd">Ending date:</label>

            <input type="date" id="dateEnd" name="dateEnd"
                   value="0000-00-00"
                   min="2020-09-01" max="2023-01-01">
        </div>
        <input type="submit" value="envoyer" />
</body>
</html>
