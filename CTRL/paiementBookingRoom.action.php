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


$message = array(
    'mastercard' => '',
    'formulaire' => ''
);

if (strlen((int)$cb) == 16){
    $hotel::paiement($room, $cb);
    header("Location: ../VIEW/confirmBooking.php");
}else{
    $message['mdp'] = "Numéro de carte invalide";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/paiementBooking.php");
}





