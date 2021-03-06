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

$numRoom = $_SESSION['numRoom'];
$newDateStart = $_SESSION['newDateStart'] ;
$newDateEnd = $_SESSION['newDateEnd'];
$hotel  = $_SESSION['hotel'];

$message = array(
    'mastercard' => '',
    'formulaire' => ''
);

if (strlen((int)$cb) == 16){
    $roomCancel = $hotel->cancelBooking($numRoom);

    $_SESSION['remboursement'] = $roomCancel[2];
    $_SESSION['room'] = $roomCancel[0];
    $_SESSION['client1'] = $roomCancel[1];

    $roomCancel = $roomCancel[0]->displayRoom();

    $_SESSION['roomCancel'] = $roomCancel;

    Tools::exportCSV($_SESSION['remboursement'],$_SESSION['client1'], $cb);
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');
    $hotel->setRevenue($date, $_SESSION['remboursement']);

    header("Location: ../VIEW/confirmCancelBooking.php");
}else{
    $message['mdp'] = "Numéro de carte invalide";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/remboursementCancelBooking.php");
}

