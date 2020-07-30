<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";

$pathCsv = "../ListeChambres_V3.csv";
$arrCsv = Tools::loadCsv($pathCsv);

$hotel = new Hotel($arrCsv);


echo $hotel->displayLastRoomFree();