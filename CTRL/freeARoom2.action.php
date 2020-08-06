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

$hotel  = $_SESSION['hotel'];

$roomFree = $hotel->freeARoom($numRoom);

$roomFree = $roomFree->displayRoom();

$_SESSION['roomFree'] = $roomFree;


header("Location: ../VIEW/confirmFreeARoom.php");
