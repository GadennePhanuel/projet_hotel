<?php
require_once ("../MODELE/Hotel.class.php");
require_once ("../MODELE/Person.class.php");
require_once ("../MODELE/Customer.class.php");
require_once ("../MODELE/Worker.class.php");
require_once ("../MODELE/Room.class.php");
require_once ("../MODELE/Tools.class.php");
session_start();


$login = $_POST['login'];
$hotel = $_SESSION['hotel'];
$identification = $hotel->authentificationLogin($login);

if($identification[1] == "customer"){

    header("Location: ../VIEW/customer.php");

}elseif ($identification[1] == "worker"){

    header("Location: ../VIEW/menu.php");
}