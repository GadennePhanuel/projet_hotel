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
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>


<?php // il faut utiliser l'attribut `enctype="multipart/form-data"` pour que le fichier puisse être envoyé ?>
<form action="../CTRL/index.action.php" method="post" enctype="multipart/form-data" >
    <label for="fichier">fichier</label> <br />
    <input name="fichier" type="file" /> <br />
    <input type="submit" value="envoyer" />
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

    unset ($_SESSION['hotel']);

?>
</body>
</html>
