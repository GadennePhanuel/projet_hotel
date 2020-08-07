<?php

require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();

$typechoose = $_POST['type'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];

$customer = $_SESSION['customer'];
$hotel = $_SESSION['hotel'];


$message = array(
    'saisi' => '',
    'formulaire' => ''
);

if((isset($typechoose) && !empty($typechoose)) && ($typechoose == 0 || $typechoose > 8)) {
    $message['saisi'] = "Veuillez saisir un nombre entre 1 et 8";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/booking.php");

}elseif($typechoose >= 1 && $typechoose <= 8){

    $booking = $hotel->booking($dateStart,$dateEnd,$customer,$typechoose);

    $dateStart = $booking->getDateStart();
    $dateEnd = $booking->getDateEnd();

    $interval = $dateStart->diff($dateEnd);
    $days = $interval->d;
    $prix = $booking->getPrice();
    $prixTotalHT = $prix * $days;
    $prixTotalTTC = $prixTotalHT * 1.2;
    $_SESSION['prixTotalTTC'] = $prixTotalTTC;

    $booking = $booking->displayRoom();
    $_SESSION['booking'] = $booking;

    header("Location: ../VIEW/paiementBooking.php");
}

