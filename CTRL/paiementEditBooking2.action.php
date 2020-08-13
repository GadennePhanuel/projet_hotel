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

$numRoom = $_SESSION['numRoom'];
$newDateStart = $_SESSION['newDateStart'];
$newDateEnd = $_SESSION['newDateEnd'];





$message = array(
    'mastercard' => '',
    'formulaire' => ''
);

if (strlen((int)$cb) == 16){

    $roomModified = $hotel->editBooking($numRoom, $newDateStart, $newDateEnd);  //recupére un tableau ($room, $client1, $prixDiff, $numOfFacture)
    $_SESSION['room'] = $roomModified[0];
    $_SESSION['prixDiff'] = $roomModified[2];
    $_SESSION['client1'] = $roomModified[1];
    $_SESSION['numOfFacture'] = $roomModified[3];
    $roomModified[0] = $roomModified[0]->displayRoom();

    $_SESSION['roomModified'] = $roomModified[0];

    if ($_SESSION['prixDiff'] >= 0){
        Tools::exportCSV($_SESSION['prixDiff'], $_SESSION['client1'], $cb);
        Tools::facture($_SESSION['client1'], $_SESSION['prixDiff'], $_SESSION['room'], $_SESSION['numOfFacture'], $cb);

        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d');
        $hotel->setRevenue($date, $_SESSION['prixDiff']);

    }else{
        Tools::exportCSV($_SESSION['prixDiff'], $_SESSION['client1'], $cb);

        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d');
        $hotel->setRevenue($date, $_SESSION['prixDiff']);
    }

    header("Location: ../VIEW/confirmEditBooking.php");
}else{
    $message['mdp'] = "Numéro de carte invalide";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/paiementEditBooking.php");
}


