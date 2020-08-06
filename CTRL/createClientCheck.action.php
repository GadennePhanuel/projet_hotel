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

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$age = $_POST["age"];
$login = $_POST['login'];
$email = $_POST['email'];
$mastercard = $_POST['mastercard'];


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

$cptA = 0;
$cptE = 0;

if ((isset($nom) && !empty($nom)) && (isset($prenom) && !empty($prenom)) && (isset($age) && !empty($age)) && (isset($login) && !empty($login)) && (isset($email) && !empty($email)) && (isset($mastercard) && !empty($mastercard))){
    if ($age < 18){
        $message['saisi'] = "Le client principal doit avoir 18 ans";
        $_SESSION['message'] = $message;

    header("Location: ../VIEW/createClient.php");
    }else{

        $customer = $hotel->createArrCustomers($nom, $prenom, $age, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptA++;
    }
}

if ((isset($nomSec) && !empty($nomSec)) && (isset($prenomSec) && !empty($prenomSec)) && (isset($ageSec) && !empty($ageSec))){
    if ($ageSec >= 18 && $cptA < 2){
        $customer = $hotel->createArrCustomers($nomSec, $prenomSec, $ageSec, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptA++;
    }
    elseif ($ageSec >= 18 && $cptA >= 2){
        $message['saisi'] = "Vous ne pouvez entrer que 2 adulte maximum";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/createClient.php");
    }
    elseif ($ageSec < 18 && $cptE < 2){
        $customer = $hotel->createArrCustomers($nomSec, $prenomSec, $ageSec, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptE++;
    }
    elseif ($ageSec < 18 && $cptE >= 2){
        $message['saisi'] = "Vous ne pouvez entrer que 2 enfant maximum";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/createClient.php");
    }
}


if ((isset($nomSec2) && !empty($nomSec2)) && (isset($prenomSec2) && !empty($prenomSec2)) && (isset($ageSec2) && !empty($ageSec2))){
    if ($ageSec2 >= 18 && $cptA < 2){
        $customer = $hotel->createArrCustomers($nomSec2, $prenomSec2, $ageSec2, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptA++;
    }
    elseif ($ageSec2 >= 18 && $cptA >= 2){
        $message['saisi'] = "Vous ne pouvez entrer que 2 adulte maximum";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/createClient.php");
    }
    elseif ($ageSec2 < 18 && $cptE < 2){
        $customer = $hotel->createArrCustomers($nomSec2, $prenomSec2, $ageSec2, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptE++;
    }
    elseif ($ageSec2 < 18 && $cptE >= 2){
        $message['saisi'] = "Vous ne pouvez entrer que 2 enfant maximum";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/createClient.php");
    }
}

if ((isset($nomSec3) && !empty($nomSec3)) && (isset($prenomSec3) && !empty($prenomSec3)) && (isset($ageSec3) && !empty($ageSec3))){
    if ($ageSec >= 18 && $cptA < 2){
        $customer = $hotel->createArrCustomers($nomSec3, $prenomSec3, $ageSec3, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptA++;
    }
    elseif ($ageSec3 >= 18 && $cptA >= 2){
        $message['saisi'] = "Vous ne pouvez entrer que 2 adulte maximum";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/createClient.php");
    }
    elseif ($ageSec3 < 18 && $cptE < 2){
        $customer = $hotel->createArrCustomers($nomSec3, $prenomSec3, $ageSec3, $login, $email, $mastercard);
        $_SESSION['customer'][] = $customer;
        $cptE++;
    }
    elseif ($ageSec3 < 18 && $cptE >= 2){
        $message['saisi'] = "Vous ne pouvez entrer que 2 enfant maximum";
        $_SESSION['message'] = $message;

        header("Location: ../VIEW/createClient.php");
    }
}

$_SESSION['displayRoomType'] = $hotel->displayRoomType();

header("Location: ../VIEW/booking.php");