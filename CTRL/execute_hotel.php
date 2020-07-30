<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";

$pathCsv = "../ListeChambres_V3.csv";
$arrCsv = Tools::loadCsv($pathCsv);

$hotel = new Hotel($arrCsv);


function facture(){
    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-Y') .'_'. date('H') .'h'. date('i') .'min'. date('s') .'sec';
    $date1 = date('d-m-Y');
    $nom = "Gadenne";
    $prenom = "Phanu";
    $cb = "010326489530";
    $price = 2500;
    $size = utf8_decode("25 m²");
    $type = "Chambre de fou deluxe XXL";
    $optionsList = "wifi, champagnes, putes et j'en passes :p";
    $view = utf8_decode("vue sur le cimetière");
    $dateStart = new DateTime('30-07-2020');
    $dateEnd = new DateTime('06-08-2020');
    $dateStartString = $dateStart->format('d-m-Y');
    $dateEndString = $dateEnd->format('d-m-Y');
    $interval = $dateStart->diff($dateEnd);
    $intervalDate = $interval->format('%d');  //format numérique en nb de jours
    $total = 17500;
    $numOfFacture = 1;

    $name = "../FILES/OUTPUT/Facture/".$nom."_".$prenom."_".$date.".pdf";

    //création du PDF en lui même avec du Style sviouplait !
    $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
    $pdf->AddPage();
    $pdf->addSociete( "Hotel Project X",
        "00000 DOHA/QUATAR\n" .
        "Simaisma, A Murwab Resort\n".
        "blablablaNiakNiak\n" .
        "Capital : 490000000 " . EURO );
    $pdf->fact_dev( "Facture ", "$numOfFacture" );
    $pdf->temporaire( "Facture" );
    $pdf->addDate( "$date1");
    $pdf->addClient("$nom");
    $pdf->addPageNumber("1");
    $pdf->addClientAdresse("Pour\nM.(Mde). $nom $prenom\nEmpreinte carte: $cb");
    $pdf->addReglement(utf8_decode("Carte bancaire"));
    $pdf->addEcheance("$date1String");
    $pdf->addNumTVA("QTR888777666");
    $pdf->addReference("$dateStartString au $dateEndString");
    $cols=array( "REFERENCE"    => 23,
        "DESIGNATION"  => 78,
        "QUANTITE"     => 22,
        "P.U. HT"      => 26,
        "MONTANT H.T." => 30,
        "TVA"          => 11 );
    $pdf->addCols( $cols);
    $cols=array( "REFERENCE"    => "L",
        "DESIGNATION"  => "L",
        "QUANTITE"     => "C",
        "P.U. HT"      => "R",
        "MONTANT H.T." => "R",
        "TVA"          => "C" );
    $pdf->addLineFormat( $cols);
    $pdf->addLineFormat($cols);
    $y    = 109;
    $line = array( "REFERENCE"    => "REF1",
        "DESIGNATION"  => "$type\n" .
            "$size\n" .
            "$view\n" .
            "$optionsList",
        "QUANTITE"     => "$intervalDate",
        "P.U. HT"      => "$price",
        "MONTANT H.T." => "$total",
        "TVA"          => "1" );

    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;



    $pdf->addCadreTVAs();

// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
    $tot_prods = array( array ( "px_unit" => $price, "qte" => $intervalDate, "tva" => 1 ));
    $tab_tva = array( "1"       => 20);
    $params  = array( "RemiseGlobale" => 0,
        "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
        "remise"         => 0,       // {montant de la remise}
        "remise_percent" => 0,      // {pourcentage de remise sur ce montant de TVA}
        "FraisPort"     => 1,
        "portTTC"        => 10,      // montant des frais de ports TTC
        // par defaut la TVA = 19.6 %
        "portHT"         => 0,       // montant des frais de ports HT
        "portTVA"        => 20,    // valeur de la TVA a appliquer sur le montant HT
        "AccompteExige" => 0,
        "accompte"         => 0,     // montant de l'acompte (TTC)
        "accompte_percent" => 0,    // pourcentage d'acompte (TTC)
        "Remarque" => "Sans acompte, svp..." );

    $pdf->addTVAs( $params, $tab_tva, $tot_prods);
    $pdf->addCadreEurosFrancs();



    $pdf->Output("F", $name );
}

$pdf = facture();