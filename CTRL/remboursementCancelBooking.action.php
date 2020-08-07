<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();

$client1 = $_SESSION['client1'];
$totalTTC = $_SESSION['remboursement'];
$cb = $_POST['mastercard'];

Tools::exportCSV($totalTTC,$client1, $cb);

header("Location: ../VIEW/confirmCancelBooking.php");