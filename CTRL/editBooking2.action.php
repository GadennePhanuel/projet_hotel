<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();


$numRoom = $_POST['id'];
$newDateStart = $_POST['newDateStart'];
$newDateEnd = $_POST['newDateEnd'];
$hotel  = $_SESSION['hotel'];

$roomModified = $hotel->editBooking($numRoom, $newDateStart, $newDateEnd);  //recupére un tableau ($room, $client1, $prixDiff, $numOfFacture)
$_SESSION['room'] = $roomModified[0];
$_SESSION['prixDiff'] = $roomModified[2];
$_SESSION['client1'] = $roomModified[1];
$_SESSION['numOfFacture'] = $roomModified[3];
$roomModified[0] = $roomModified[0]->displayRoom();

$_SESSION['roomModified'] = $roomModified[0];


header("Location: ../VIEW/paiementEditBooking.php");