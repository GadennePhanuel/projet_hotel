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

$roomCancel = $hotel->cancelBooking($numRoom);

$roomCancel = $roomCancel->displayRoom();

$_SESSION['roomCancel'] = $roomCancel;


header("Location: ../VIEW/confirmCancelBooking.php");