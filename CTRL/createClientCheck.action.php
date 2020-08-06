<?php

require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();

$hotel = $_SESSION['hotel'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$age = $_POST['age'];
$login = $_POST['login'];
$email = $_POST['email'];
$mastercard = $_POST['mastercard'];
$clientSec = $_POST['clientSec'];

$customers = $hotel->createArrCustomers($nom, $prenom, $age, $login, $email, $mastercard, $clientSec);

$_SESSION['customer'] = $customers;

$message = array(
    'saisi' => '',
    'formulaire' => ''
);


if($clientSec == "oui"){

    header("Location: ../VIEW/createClientSec.php");

}elseif($clientSec == "non"){

    header("Location: ../VIEW/booking.php");

}else{

    $message['saisi'] = "Veuillez retouner oui/non";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/createClient.php");
}
