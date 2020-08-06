<?php

require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();

$password = $_POST['password'];
$login = $_SESSION['login'];
$hotel  = $_SESSION['hotel'];

$message = array(
    'mdp' => '',
    'formulaire' => ''
);
//on appelle la fonction de vérification du mot de passe

if ($hotel->authentificationPassword($login,$password) == "true"){

    $arrRoomsBookedSimple = $hotel->displayRoomsBookedSimple();
    $_SESSION['roomsBookedSimple'] = $arrRoomsBookedSimple;

    header("Location: ../VIEW/freeARoom.php");
}else{
    $message['mdp'] = "Mauvais mot de passe";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/passwordFree.php");
}
