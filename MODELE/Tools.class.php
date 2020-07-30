<?php
require_once "fpdf182/fpdf.php";

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

    public static function exportCSV($total,$cb){
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y') .'_'. date('H') .'h'. date('i') .'min'. date('s') .'sec';

        $pathOut = "../FILES/OUTPUT/paiement_$date.csv";

        $fp = fopen($pathOut, "x");

        if($total < 0){
           $natureOp = "remboursement";
        }else{
            $natureOp = "Paiement";
        }

        $tmp = [$date,$natureOp,$total,$cb];

        foreach($tmp as $fields){

            $fields = array_map("utf8_decode", $fields);

            fputcsv($fp, $fields, ",", " ", " ");
        }
        fclose($fp);
    }

    public static function facture($client1, $total){
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y') .'_'. date('H') .'h'. date('i') .'min'. date('s') .'sec';
        $nom = $client1->getNom();
        $prenom = $client1->getPrenom();
        $cb = $client1->getMastercard();

        $name = "../FILES/OUTPUT/Facture/".$nom."_".$prenom."_".$date.".pdf";

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',20);
        $pdf->Cell(180,5,'Projet Hotel !!!', 0, 0, 'C' );
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(176, 10, 'Facture de votre séjour', 0, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(30, 10, $nom.' '.$prenom, 0, 2, 'L');
        $pdf->Cell(30, 10, 'Prix du séjour: '.$total, 0, 2, 'L');
        $pdf->Cell(30, 10, 'Moyen de paiement: '.$cb, 0, 2, 'L');



        $pdf->Output("F", $name );
    }
}

