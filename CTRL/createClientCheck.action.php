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

$nomSec = $_POST['nomSec'];
$prenomSec = $_POST['prenomSec'];
$ageSec = $_POST['ageSec'];

$nomSec2 = $_POST['nomSec2'];
$prenomSec2 = $_POST['prenomSec2'];
$ageSec2 = $_POST['ageSec2'];

$nomSec3 = $_POST['nomSec3'];
$prenomSec3 = $_POST['prenomSec3'];
$ageSec3 = $_POST['ageSec3'];


$message = array(
    'saisi' => '',
    'formulaire' => ''
);


if ($age < 18){
    $message['saisi'] = "Le client principal doit avoir 18 ans";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/createClient.php");;
}else{

    $customer = $hotel->createArrCustomers($nom, $prenom, $age, $login, $email, $mastercard);
    $_SESSION['customer'][] = $customer;
}



if (($age >= 18 && $ageSec >= 18 && $ageSec2 >= 18 ) || ($age >= 18 && $ageSec >= 18 && $ageSec3 >= 18) || ($age >= 18 && $ageSec2 >= 18 && $ageSec3 >= 18)) {
    $message['saisi'] = "2 adultes maximum par chambre";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/createClient.php");

}elseif($ageSec < 18 && $ageSec2 < 18 && $ageSec3 < 18){
    $message['saisi'] = "2 enfants maximum par chambre";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/createClient.php");
    
}elseif(($age >= 18 && $ageSec >= 18) || ($age >= 18 && $ageSec < 18 )) {

    $customer = $hotel->createArrCustomers($nomSec, $prenomSec, $ageSec, $login, $email, $mastercard);
    $_SESSION['customer'][] = $customer;

}elseif(($age >= 18 && $ageSec2 >= 18) || ($age >= 18 && $ageSec2 < 18 )){

    $customer = $hotel->createArrCustomers($nomSec2, $prenomSec2, $ageSec2, $login, $email, $mastercard);
    $_SESSION['customer'][] = $customer;

}elseif(($age >= 18 && $ageSec3 >= 18) || ($age >= 18 && $ageSec3 < 18 )){

    $customer = $hotel->createArrCustomers($nomSec3, $prenomSec3, $ageSec3, $login, $email, $mastercard);
    $_SESSION['customer'][] = $customer;
}

header("Location: ../VIEW/booking.php");