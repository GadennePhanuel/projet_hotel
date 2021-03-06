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
    <title>booking</title>
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
                <h1>Types de chambre</h1>
            </div>
        </div>

        <div class="listTypeRoom">
            <?php $displayRoomType = $_SESSION['displayRoomType'];
            foreach($displayRoomType as $type){?>
                <div class="typeRoom">
                    <?php $list = $type;
                    foreach ($list as $key => $value){?>
                        <p><?php echo $key. ' ' .$value. "<br>" ?></p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <form action="../CTRL/bookingRoom.action.php" method="post" class="formBooking">
            <div class="form-example">
                <label for="type">Saisissez le type de chambre souhaitée : </label>
                <input type="number" name="type" id="type" min="1" max="8" placeholder="1-8" required>

            </div>
            <div >
                <label for="dateStart">Date d'arrivée : </label>

                <input type="date" id="dateStart" name="dateStart"
                       required
                       value="0000-00-00"
                       min="<?php echo date("Y-m-d"); ?>" max="<?php $d=strtotime("+2 Years"); echo date("Y-m-d", $d); ?>">
            </div>
            <div >
                <label for="dateEnd">Date de départ : </label>

                <input type="date" id="dateEnd" name="dateEnd"
                       required
                       value="0000-00-00"
                       min="<?php $d=strtotime("+1 Day"); echo date("Y-m-d", $d); ?>" max="<?php $d=strtotime("+2 Years"); echo date("Y-m-d", $d); ?>">
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

            <div class="row justify-content-center submitBooking">
                    <input type="submit"  class="btn btn-secondary btn-secondary2" value="Valider" />
            </div>
        </form>

        <footer>
            <p>Projet aout 2020 - PGA && MVI.</p>
        </footer>
    </div>
</body>
</html>
