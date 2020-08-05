<?php
require_once ("../MODELE/Hotel.class.php");
require_once ("../MODELE/Person.class.php");
require_once ("../MODELE/Customer.class.php");
require_once ("../MODELE/Worker.class.php");
require_once ("../MODELE/Room.class.php");
require_once ("../MODELE/Tools.class.php");
session_start();

//recupere login
$login = $_POST['login'];
//stockage du login
$_SESSION['login'] = $login;

// recupere objet hotel
$hotel = $_SESSION['hotel'];

$identification = $hotel->authentificationLogin($login);

$messages = array(
    'login' => '',
    'formulaire' => ''
);

// Controle du login
// comparaison du login recupéré avec celui existant
if($identification[1] == "customer"){

    $displayCustomerRoom = $hotel->displayCustomerRoom($login);
    $_SESSION['displayCustomerRoom'] = $displayCustomerRoom;

    header("Location: ../VIEW/customer.php");

}elseif ($identification[1] == "worker"){

    header("Location: ../VIEW/menu.php");

}elseif($identification[1] != "customer" && $identification[1] != "worker"){

    $message['login'] = "Votre login n'est pas valide";
    $_SESSION['message'] = $message;
    header("Location: ../VIEW/login.php");
}