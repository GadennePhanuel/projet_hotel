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
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1>Chambres occupés</h1>
            </div>
        </div>
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

            <div class="row justify-content-center">
                <div class="col-3">
                    <input type="submit"  class="btn btn-success" value="envoyer" />
                    <button type="button" class="btn btn-primary"><a href="menu.php">Retour au menu</a></button>
                </div>
            </div>
    </div>
</body>
</html>
