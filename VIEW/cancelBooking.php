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

    <title>editBooking.php</title>
</head>
<body>
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-8">
            <h1>Selectionnez la chambre à annuler</h1>
        </div>

    </div>
    <?php if (is_array($_SESSION['roomsBookedSimple'])){ ?>
        <form action="../CTRL/cancelBooking2.action.php" method="post" >
            <?php foreach ($_SESSION['roomsBookedSimple'] as $room){ ?>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="radio" checked id="<?php echo $room[0] ?>" name="id" value="<?php echo $room[0] ?>">

                        <label for="<?php echo $room[0] ?>" >
                            Chambre n°
                            <?php foreach ($room as $content){ ?>
                                <?php echo $content. " "?>
                            <?php } ?>
                        </label>
                        </input>
                    </div>
                </div>
            <?php } ?>


            <div class="row justify-content-center">
                <div class="col-8">
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </div>
            </div>
        </form>


    <?php }else{ ?>
        <div class="row justify-content-center">
            <div class="col-8">
                <p>
                    <?php echo $_SESSION['roomsBookedSimple']. "<br>"?>
                </p>
            </div>
        </div>
    <?php } ?>

    <div class="row justify-content-center">
        <div class="col-3">
            <button type="button" class="btn btn-primary"><a href="menu.php">Retour au menu</a></button>
        </div>
    </div>
</div>

<?php unset($_SESSION['roomModified']);
;
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
