<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();


$cb = $_POST['mastercard'];
$room = $_SESSION['room'];
$hotel = $_SESSION['hotel'];

$prixDiff = $_SESSION['prixDiff'];
$client1 = $_SESSION['client1'];
$numOfFacture = $_SESSION['numOfFacture'];
if ($prixDiff >= 0){
    Tools::exportCSV($prixDiff, $client1, $cb);
    Tools::facture($client1, $prixDiff, $room, $numOfFacture, $cb);
}else{
    Tools::exportCSV($prixDiff, $client1, $cb);
}

header("Location: ../VIEW/confirmEditBooking.php");