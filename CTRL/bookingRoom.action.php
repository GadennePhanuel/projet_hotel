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
$_SESSION['typechoose'] = $typechoose;
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];
$_SESSION['dateStart'] = $dateStart;
$_SESSION['dateEnd'] = $dateEnd;


$customer = $_SESSION['customer'];
$hotel = $_SESSION['hotel'];


$message = array(
    'saisi' => '',
    'formulaire' => ''
);
$dateStart1 = new DateTime($dateStart);
$dateEnd1 = new DateTime($dateEnd);


if ((isset($dateStart) && !empty($dateStart)) && (isset($dateEnd) && !empty($dateEnd)) && ($dateStart1 > $dateEnd1 || $dateStart1 == $dateEnd1)){
    $message['saisi'] = "veuillez saisir des dates de réservation valide";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/booking.php");
}else{
    if((isset($typechoose) && !empty($typechoose)) && ($typechoose == 0 || $typechoose > 8)) {
        $message['saisi'] = "Veuillez saisir un nombre entre 1 et 8";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/booking.php");

    }else{
        //$booking = $hotel->booking($dateStart,$dateEnd,$customer,$typechoose);
        $roomType = $hotel->displayRoomType();
        $roomChoose = $roomType[$typechoose - 1];

        //$dateStart = $booking->getDateStart();
        //$dateEnd = $booking->getDateEnd();


        $interval = (new DateTime($dateStart))->diff(new DateTime($dateEnd));
        $days = $interval->d;
        //$prix = $roomChoose->getPrice();
        $prix = intval($roomChoose['Prix: ']);
        $_SESSION['prix'] = $prix;
        $prixTotalHT = $prix * $days;
        $prixTotalTTC = $prixTotalHT * 1.2;
        $_SESSION['prixTotalTTC'] = $prixTotalTTC;


        $_SESSION['room'] = $roomChoose;

        //$booking = $roomChoose->displayRoom();
        $_SESSION['booking'] = $booking;
        header("Location: ../VIEW/paiementBooking.php");
    }

}

