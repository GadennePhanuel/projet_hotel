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

$cond1 = true;
while($cond1){
    $identification = $hotel->authentificationLogin();
    if ($identification == "customer"){

    }
    else if ($identification == "worker"){
        $cond2 = true;
        while($cond2){
            echo "--------------------Module MENU--------------------\n";
            echo "  A- Afficher l’état de l’hôtel\n";
            echo "  B- Afficher le nombre de chambres réservées\n";
            echo "  C- Afficher le nombre de chambres libres\n";
            echo "  D- Afficher le numéro de la première chambre vide\n";
            echo "  E- Afficher le numéro de la dernière chambre vide\n";
            echo "  F- Réserver une chambre\n";
            echo "  G- Libérer une chambre\n";
            echo "  H- Modifier une réservation\n";
            echo "  I- Annuler une réservation\n";
            echo "Q- Quitter\n";
            echo "---------------------------------------------------\n";
            echo "Votre choix: \n";
            $rep = readline();

            switch ($rep){
                case 'A':
                    echo $hotel->displayHotel();
                    break;
                case 'B':
                    echo $hotel->displayNbRoomBooked();
                    break;
                case 'C':
                    echo $hotel->displayNbRoomFree();
                    break;
                case 'D':
                    echo $hotel->displayFirstRoomFree();
                    break;
                case 'E':
                    echo $hotel->displayLastRoomFree();
                    break;
                case 'F':
                    $hotel->booking();
                    break;
                case 'G':
                    $hotel->freeARoom();
                    break;
                case 'H':
                    $hotel->editBooking();
                    break;
                case 'I':
                    $hotel->cancelBooking();
                    break;
                case 'Q':
                    echo "fin du module MENU\n";
                    $cond2 = false;
            }
        }
    }else{
        echo "login inexistant\n";
    }
}







