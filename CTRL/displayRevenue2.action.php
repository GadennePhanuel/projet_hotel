<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();


$date = $_POST['date'];

$message = array(
    'mdp' => '',
    'formulaire' => ''
);

if(isset($date) && !empty($date)){
    $revenue = Hotel::displayRevenue($date);

    $_SESSION['date'] = $date;
    $_SESSION['revenue'] = $revenue;

    header("Location: ../VIEW/displayRevenue.php");
}else{

    $message['mdp'] = "date invalide";
    $_SESSION['message'] = $message;

    header("Location: ../VIEW/revenue.php");
}
