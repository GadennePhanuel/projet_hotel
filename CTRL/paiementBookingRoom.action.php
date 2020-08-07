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

$hotel::paiement($room, $cb);

header("Location: ../VIEW/confirmBooking.php");