<?php


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
}

