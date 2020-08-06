<?php

require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();


//recupere le password
$password = $_POST['password'];
$login = $_SESSION['login'];
$_SESSION['password'] = $password;
$hotel = $_SESSION['hotel'];
$authentificationPassword =  $hotel->authentificationPassword($login,$password);


$message = array(
    'mdp' => '',
    'formulaire' => ''
);

if( $authentificationPassword != "true"){
    $message['mdp'] = "Mauvais mot de passe";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/passwordBooking.php");
}elseif($authentificationPassword == "true" ){

    header("Location: ../VIEW/createClient.php");
}