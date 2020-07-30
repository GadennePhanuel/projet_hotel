<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";

$pathCsv = "../ListeChambres_V3.csv";
$arrCsv = Tools::loadCsv($pathCsv);

$hotel = new Hotel($arrCsv);


function facture(){
    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-Y') .'_'. date('H') .'h'. date('i') .'min'. date('s') .'sec';
    $nom = "vigin";
    $prenom = "marie";
    $cb = "012014533412";

    $name = "../FILES/OUTPUT/Facture/".$nom."_".$prenom."_".$date.".pdf";

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Times','B',20);
    $pdf->Cell(180,5,'Projet Hotel !!!', 0, 0, 'C' );
    $pdf->Ln();
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(176, 10, utf8_decode('Facture de votre séjour'), 0, 0, 'C');
    $pdf->Ln();
    $pdf->Cell(30, 10, utf8_decode($nom.' '.$prenom), 0, 2, 'L');
    $pdf->Cell(30, 10, utf8_decode('Prix du séjour: '.'1012121212'), 0, 2, 'L');
    $pdf->Cell(30, 10, utf8_decode('Moyen de paiement: ').$cb, 0, 2, 'L');



    $pdf->Output("F", $name);
}

$pdf = facture();