<?php
require_once "PDF_Invoice.class.php";

class Tools
{

    public static function loadCsv(String $pathCsv)
    {
        //si l'ouverture du fichier s'effectue correctement
        if (($pathCsv = fopen($pathCsv, "r")) !== false){
            //on boucle pour lire chaque ligne du fichier
            while(($data = fgetcsv($pathCsv, 0, ';')) !== false){
                $arrayCsv[] = $data;
            }
            $nbRow = count($arrayCsv);
            $nbCol = count($arrayCsv[0]);
            for ($i = 1; $i < $nbRow; $i++){
                $arrayCsv[$i][$nbCol-1] = explode("|", $arrayCsv[$i][$nbCol-1]);
            }
            return $arrayCsv;
        }
    }

    public static function exportCSV($totalTTC,$cb){
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y');

        $pathOut = "../FILES/OUTPUT/Bilan/paiement_$date.csv";

        $fp = fopen($pathOut, "x");


        if($totalTTC < 0){
           $natureOp = "remboursement";
        }else{
            $natureOp = "Paiement";
        }


        $tmp = array($date,$natureOp,$totalTTC,$cb);

        $fields = array_map("utf8_decode", $tmp);
        fputcsv($fp, $tmp, ",", " ", " ");

        fclose($fp);
    }

    public static function facture($client1, $total, $room, $numOfFacture){
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y') .'_'. date('H') .'h'. date('i') .'min'. date('s') .'sec';
        $date1 = date('d-m-Y');
        $nom = utf8_decode($client1->getNom());
        $prenom = utf8_decode($client1->getPrenom());
        $cb = $client1->getMastercard();
        $price = $room->getPrice();
        $size = utf8_decode($room->getSize());
        $type = utf8_decode($room->getType());
        $optionsList = utf8_decode($room->getOptionList());
        $view = utf8_decode($room->getView());
        $dateStart = $room->getDateStart();
        $dateStartString = $dateStart->format('d-m-Y');
        $dateEnd = $room->getDateEnd();
        $dateEndString = $dateEnd->format('d-m-Y');
        $interval = $dateStart->diff($dateEnd);
        $intervalDate = $interval->format('%d');  //format numérique en nb de jours

        $name = "../FILES/OUTPUT/Facture/".$nom."_".$prenom."_".$date.".pdf";

        //création du PDF en lui même avec du Style sviouplait !
        $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
        $pdf->AddPage();
        $pdf->addSociete( "Hotel Project X",
            "00000 DOHA/QUATAR\n" .
            "Simaisma, A Murwab Resort\n".
            "Capital : 490000000 " . EURO );
        $pdf->fact_dev( "Facture ", "$numOfFacture" );
        $pdf->temporaire( "Facture" );
        $pdf->addDate( "$date1");
        $pdf->addClient("$nom");
        $pdf->addPageNumber("1");
        $pdf->addClientAdresse("Pour\nM.(Mde.) $nom $prenom\nEmpreinte carte: $cb");
        $pdf->addReglement("Carte bancaire");
        $pdf->addEcheance("$date1");
        $pdf->addNumTVA("QTR888777666");
        $pdf->addReference("$dateStartString au $dateEndString");
        $cols=array( "REFERENCE"    => 23,
            "DESIGNATION"  => 78,
            "Nb jour"     => 22,
            "P.U. HT"      => 26,
            "MONTANT H.T." => 30,
            "TVA"          => 11 );
        $pdf->addCols( $cols);
        $cols=array( "REFERENCE"    => "L",
            "DESIGNATION"  => "L",
            "Nb jour"     => "C",
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
            "Nb jour"     => "$intervalDate",
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
            "FraisPort"     => 0,
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

}

