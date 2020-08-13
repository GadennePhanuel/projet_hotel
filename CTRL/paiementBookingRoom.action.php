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

$typechoose = $_SESSION['typechoose'];
$dateStart = $_SESSION['dateStart'];
$dateEnd = $_SESSION['dateEnd'];
$customer = $_SESSION['customer'];

$message = array(
    'mastercard' => '',
    'formulaire' => ''
);


if (strlen((int)$cb) == 16){

    $booking = $hotel->booking($dateStart,$dateEnd,$customer,$typechoose);

    $dateStart = $booking->getDateStart();
    $dateEnd = $booking->getDateEnd();

    $interval = $dateStart->diff($dateEnd);
    $days = $interval->d;
    $prix = $booking->getPrice();
    $prixTotalHT = $prix * $days;
    $prixTotalTTC = $prixTotalHT * 1.2;
    $_SESSION['prixTotalTTC'] = $prixTotalTTC;
    $_SESSION['room'] = $booking;

    $booking = $booking->displayRoom();
    $_SESSION['booking'] = $booking;


    $hotel->paiement($_SESSION['room'], $cb);
    header("Location: ../VIEW/confirmBooking.php");
}else{
    $message['mdp'] = "Numéro de carte invalide";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/paiementBooking.php");
}





