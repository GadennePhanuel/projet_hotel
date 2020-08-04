<?php
require_once "Worker.class.php";

class Hotel
{
    private $nbRoomTotal = 0;
    private $nbRoomFree = 0;
    private $nbRoomOccupied = 0;
    private $workers = array();
    private $nbCustomer = 0;
    private $rooms = array();
    private $roomsCVP = array();
    private $roomsCVJ = array();
    private $roomsCVO = array();
    private $roomsCVIO = array();
    private $roomsCDA = array();
    private $roomsExec = array();
    private $roomsAmb = array();
    private $roomsRoyale = array();
    private $revenue;
    private $arrCsv;
    private static $nbPaiement = 0;


    public function __construct(array $arrCsv)
    {
        $this->arrCsv = $arrCsv;
        $nbRow = count($this->arrCsv);
        for ($i=1; $i <$nbRow; $i++ ){
            for ($j = 0; $j < $this->arrCsv[$i][5]; $j++){
                $this->rooms[] = new Room($this->arrCsv[$i][0], $this->arrCsv[$i][1], $this->arrCsv[$i][2], $this->arrCsv[$i][4], $this->arrCsv[$i][6]);
                $this->nbRoomTotal++;
                $this->nbRoomFree++;
            }
        }
        foreach ($this->rooms as $typeRoom){
            $type = $typeRoom->getType();
            switch ($type){
                case 'Chambre Vue Piscine':
                    $this->roomsCVP[] = $typeRoom;
                    break;
                case 'Chambre Vue Jardin':
                    $this->roomsCVJ[] = $typeRoom;
                    break;
                case 'Chambre Vue Océan':
                    $this->roomsCVO[] = $typeRoom;
                    break;
                case 'Chambre vue imprenable sur l\'océan':
                    $this->roomsCVIO[] = $typeRoom;
                    break;
                case 'Suite CDA':
                    $this->roomsCDA[] = $typeRoom;
                    break;
                case 'Suite Executive':
                    $this->roomsExec[] = $typeRoom;
                    break;
                case 'Suite Ambassadeur':
                    $this->roomsAmb[] = $typeRoom;
                    break;
                case 'Suite Royale':
                    $this->roomsRoyale[] = $typeRoom;
                    break;
            }
        }
        $this->workers = array(new Worker("Gadenne", "Phanuel", 29, "Admin1", "Admin1"), new Worker("Vigin", "Marie", 26, "Admin2", "Admin2"));
    }

    public function authentificationLogin($log)
    {

        foreach ($this->rooms as $room){
            $customers = $room->getCustomers();
            foreach ($customers as $customer){
                $arrLogCustomer[] = $customer->getLogin();
            }
        }
        if ((isset($arrLogCustomer) && !empty($arrLogCustomer)) && in_array($log, $arrLogCustomer)){
                return array($log, "customer");
        }
        else{
            foreach ($this->workers as $worker){
                $arrLogWorkers[] = $worker->getLogin();
            }
            if (in_array($log, $arrLogWorkers)){
                return array($log, "worker");
            }
        }
    }

    
    public function authentificationPassword($log)
    {
        echo "Donnez votre mdp: ";
        $mdp = readline();

        foreach ($this->workers as $worker){
            $password = $worker->getPassword();
            $login = $worker->getLogin();
            if ($log == $login && $mdp == $password){
                return "true";
            }
        }
    }

    public function displayNbRoomFree(){
        $cpt = 0;
        foreach ($this->rooms as $room){
            if($room->getIsEmpty() == 0){
                $cpt++;
            }
        }
        $this->nbRoomFree = $cpt;
        return "le nombre de chambres disponibles dans l'hotel est :" .$this->nbRoomFree."\n";
    }

    public function displayNbRoomBooked(){
        $cpt = 0;
        foreach ($this->rooms as $room){
            if($room->getIsEmpty() == 1){
                $cpt++;
            }
        }
        $this->nbRoomOccupied = $cpt;
        return "le nombre de chambres réservées dans l'hotel est :" .$this->nbRoomOccupied."\n";
    }

    public function displayHotel(){
        $displayNbRoomFree = $this->displayNbRoomFree();

        $displayNbRoomBooked = $this->displayNbRoomBooked();

        $cpt = 0;
        foreach ($this->rooms as $room){
            $customers = $room->getCustomers();
            if (isset($customers) && !empty($customers)){
                foreach ($customers as $customer){
                    if (isset($customer) && !empty($customer)){
                        $cpt++;
                    }
                }
            }
        }
        $this->nbCustomer = $cpt;
        return $displayNbRoomFree . "\n" . $displayNbRoomBooked . "\n" . "Nous avons actuellement ".$this->nbCustomer. " clients présents dans notre établissement.\n";
    }

    public function displayFirstRoomFree(){
        $arrayLibre = [];
        foreach($this->rooms as $key => $listLibre){
            if($listLibre->getIsEmpty() == 0){
                $arrayLibre[$key+1] = $listLibre;
            }
        }
        $preChambre = array_key_first($arrayLibre);
        return "Le numéro de la premiere chambre libre est : ".$preChambre."\n";
    }

    public function displayLastRoomFree(){
        $arrayLibre = [];
        foreach($this->rooms as $key => $listLibre){
            if($listLibre->getIsEmpty() == 0){
                $arrayLibre[$key+1] = $listLibre;
            }
        }
        $derChambre = array_key_last($arrayLibre);
        return "Le numéro de la derniere chambre libre est : ".$derChambre."\n";
    }


    public function displayCustomerRoom($log)
    {
        foreach ($this->rooms as $room) {
            if ($room->getIsEmpty() == 1) {
                $customers = $room->getCustomers();
                foreach ($customers as $customer) {
                    $login = $customer->getLogin();

                    if ($login == $log) {
                        $tmp1 = $room->getDateStart();
                        $tmp2 = $room->getDateEnd();
                        return "Prenom: " . $customer->getPrenom() . "\n" .
                            "Nom: " . $customer->getNom() . "\n" .
                            "Numéro de chambre: " . $room->getId() . "\n" .
                            "Type de chambre: " . $room->getType() . "\n" .
                            "Date d'entrée: " . $tmp1->format('d-m-Y') . "\n" .
                            "Date de sortie: " . $tmp2->format('d-m-Y') . "\n";
                    }
                }
            }
        }
    }
    
    public function booking (){
        $cptCVP = 0;
        foreach ($this->roomsCVP as $room){
            if($room->getisEmpty() ==0){
                $cptCVP ++;
            }
        }
        if ($cptCVP > 0){
            echo "Chambre 1: ".$this->roomsCVP[0]->getType()."\n".
                 "Vue : ".$this->roomsCVP[0]->getView()."\n".
                 "Surface: ".$this->roomsCVP[0]->getSize()."\n".
                 "Options :".$this->roomsCVP[0]->getOptionList()."\n".
                 "Prix: ".$this->roomsCVP[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptCVJ = 0;
        foreach ($this->roomsCVJ as $room){
            if($room->getisEmpty() ==0){
                $cptCVJ ++;
            }
        }
        if ($cptCVJ > 0){
            echo "Chambre 2: ".$this->roomsCVJ[0]->getType()."\n".
                "Vue : ".$this->roomsCVJ[0]->getView()."\n".
                "Surface: ".$this->roomsCVJ[0]->getSize()."\n".
                "Options :".$this->roomsCVJ[0]->getOptionList()."\n".
                "Prix: ".$this->roomsCVJ[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptCVO = 0;
        foreach ($this->roomsCVO as $room){
            if($room->getisEmpty() ==0){
                $cptCVO ++;
            }
        }
        if ($cptCVO > 0){
            echo "Chambre 3: ".$this->roomsCVO[0]->getType()."\n".
                "Vue : ".$this->roomsCVO[0]->getView()."\n".
                "Surface: ".$this->roomsCVO[0]->getSize()."\n".
                "Options :".$this->roomsCVO[0]->getOptionList()."\n".
                "Prix: ".$this->roomsCVO[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptCVIO = 0;
        foreach ($this->roomsCVIO as $room){
            if($room->getisEmpty() ==0){
                $cptCVIO ++;
            }
        }
        if ($cptCVIO > 0){
            echo "Chambre 4: ".$this->roomsCVIO[0]->getType()."\n".
                "Vue : ".$this->roomsCVIO[0]->getView()."\n".
                "Surface: ".$this->roomsCVIO[0]->getSize()."\n".
                "Options :".$this->roomsCVIO[0]->getOptionList()."\n".
                "Prix: ".$this->roomsCVIO[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptCDA = 0;
        foreach ($this->roomsCDA as $room){
            if($room->getisEmpty() ==0){
                $cptCDA ++;
            }
        }
        if ($cptCDA > 0){
            echo "Chambre 5: ".$this->roomsCDA[0]->getType()."\n".
                "Vue : ".$this->roomsCDA[0]->getView()."\n".
                "Surface: ".$this->roomsCDA[0]->getSize()."\n".
                "Options :".$this->roomsCDA[0]->getOptionList()."\n".
                "Prix: ".$this->roomsCDA[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptExec = 0;
        foreach ($this->roomsExec as $room){
            if($room->getisEmpty() ==0){
                $cptExec ++;
            }
        }
        if ($cptExec > 0){
            echo "Chambre 6: ".$this->roomsExec[0]->getType()."\n".
                "Vue : ".$this->roomsExec[0]->getView()."\n".
                "Surface: ".$this->roomsExec[0]->getSize()."\n".
                "Options :".$this->roomsExec[0]->getOptionList()."\n".
                "Prix: ".$this->roomsExec[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptAmb = 0;
        foreach ($this->roomsAmb as $room){
            if($room->getisEmpty() ==0){
                $cptAmb ++;
            }
        }
        if ($cptAmb > 0){
            echo "Chambre 7: ".$this->roomsAmb[0]->getType()."\n".
                "Vue : ".$this->roomsAmb[0]->getView()."\n".
                "Surface: ".$this->roomsAmb[0]->getSize()."\n".
                "Options :".$this->roomsAmb[0]->getOptionList()."\n".
                "Prix: ".$this->roomsAmb[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $cptRoyale = 0;
        foreach ($this->roomsRoyale as $room){
            if($room->getisEmpty() ==0){
                $cptRoyale ++;
            }
        }
        if ($cptRoyale > 0){
            echo "Chambre 8: ".$this->roomsRoyale[0]->getType()."\n".
                "Vue : ".$this->roomsRoyale[0]->getView()."\n".
                "Surface: ".$this->roomsRoyale[0]->getSize()."\n".
                "Options :".$this->roomsRoyale[0]->getOptionList()."\n".
                "Prix: ".$this->roomsRoyale[0]->getPrice()."\n";
            echo PHP_EOL;
        }

        $typechoose = "";
        $c3 = true;
        while ($c3){
            echo "Quel type de chambres choisissez-vous?(1 à 8): \n";
            $res = readline();
            switch ($res){
                case '1':
                    $typechoose = "Chambre Vue Piscine";
                    $c3 = false;
                    break;
                case '2':
                    $typechoose = "Chambre Vue Jardin";
                    $c3 = false;
                    break;
                case '3':
                    $typechoose = "Chambre Vue Océan";
                    $c3 = false;
                    break;
                case '4':
                    $typechoose = "Chambre vue imprenable sur l'océan";
                    $c3 = false;
                    break;
                case '5':
                    $typechoose = "Suite CDA";
                    $c3 = false;
                    break;
                case '6':
                    $typechoose = "Suite Executive";
                    $c3 = false;
                    break;
                case '7':
                    $typechoose = "Suite Ambassadeur";
                    $c3 = false;
                    break;
                case '8':
                    $typechoose = "Suite Royale";
                    $c3 = false;
                    break;
                default:
                    echo "pas compris\n";
            }
        }

        //selection de la première Room correspondante à son choix
        $roomChoose = "";
        foreach ($this->rooms as $room){
            if (($room->getType() == $typechoose) && ($room->getIsEmpty() == 0)){
                $roomChoose = $room;
                break;
            }
        }

        //on demande les dates d'entrée et de sorties
        echo "date d'entrée (jj-mm-aaaa): \n";
        $dateStart = new DateTime(readline());
        echo "date de sortie (jj-mm-aaaa): \n";
        $dateEnd = new DateTime(readline());

        $roomChoose->setCustomers($this->createArrCustomers());
        $roomChoose->setIsEmpty(1);
        $roomChoose->setDateStart($dateStart);
        $roomChoose->setDateEnd($dateEnd);

        echo "Ok chambre numéro ". $roomChoose->getId(). " bien réservé au nom de M.(Mde.)".$roomChoose->getCustomers()[0]->getNom()."\n";
        $this->paiement($roomChoose);
    }

    public function paiement($room){
        self::$nbPaiement++;
        $numOfFacture = self::$nbPaiement;

        $dateStart = $room->getDateStart();
        $dateEnd = $room->getDateEnd();
        $interval = $dateStart->diff($dateEnd);
        $intervalDate = $interval->format('%d');  //format numérique en nb de jours
        $price = $room->getPrice();
        $prixTotal = $intervalDate * $price;
        $prixTotalTTC = $prixTotal * 1.2;

        $CA = $this->revenue;
        $CA = $CA + $prixTotalTTC;
        $this->revenue = $CA;

        $client1 = $room->getCustomers()[0];


        Tools::exportCSV($prixTotalTTC,$client1);
        Tools::facture($client1, $prixTotal, $room, $numOfFacture);
    }


    public function editBooking(){
        echo "Module modification de dates de réservation\n";
        $c1 = true;
        while ($c1){
            echo "Quel est le numéro de la chambre à éditer?(1 à ".count($this->rooms)."): \n";
            $res = readline();
            if (($res > 0 && $res <= count($this->rooms)) && ($this->rooms[$res-1]->getIsEmpty() == 1)){
                self::$nbPaiement++;
                $numOfFacture = self::$nbPaiement;
                $room = $this->rooms[$res-1];

                $dateStart = $room->getDateStart();
                $dateEnd = $room->getDateEnd();
                $interval = $dateStart->diff($dateEnd);
                $intervalDate = $interval->format('%d');  //format numérique en nb de jours
                $price = $room->getPrice();
                $prixTotal = $intervalDate * $price;
                $prixTotalTTC = $prixTotal * 1.2;

                echo "nouvelle date d'entrée: \n";
                $newDateStart = new DateTime(readline());
                $room->setDateStart($newDateStart);
                echo "nouvelle date de sortie: \n";
                $newDateEnd = new DateTime(readline());
                $room->setDateEnd($newDateEnd);
                $interval = $newDateStart->diff($newDateEnd);
                $intervalDate = $interval->format('%d');  //format numérique en nb de jours
                $newPrixTotal = $intervalDate * $price;
                $newPrixTotalTTC = $newPrixTotal * 1.2;

                $prixDiff = $newPrixTotalTTC - $prixTotalTTC;


                $client1 = $room->getCustomers()[0];

                if($prixDiff > 0){
                    $this->revenue = $this->revenue + $prixDiff;
                    Tools::exportCSV($prixDiff,$client1);
                    Tools::facture($client1, $prixDiff, $room, $numOfFacture);
                }
                else if ($prixDiff < 0){
                        $this->revenue = $this->revenue + $prixDiff;
                        Tools::exportCSV($prixDiff,$client1);
                }
                $c1 = false;

            }else{
                echo "tu dis de la merde\n";
            }
        }
    }

    public function freeARoom()
    {
        $c1 = true;
        while ($c1) {
            echo "Quel est le numéro de la chambre à libérer?(1 à " . count($this->rooms) . "): \n";
            $res = readline();

            if (($res > 0 && $res <= count($this->rooms)) && ($this->rooms[$res - 1]->getIsEmpty() == 1)) {
                $room = $this->rooms[$res - 1];
                $room->setIsEmpty(0);
                $room->setCustomers(array());
                $room->setDateStart('00-00-0000');
                $room->setDateEnd('00-00-0000');
                $c1 = false;
            }
            else{
                echo "taper un numéro de chambre valide et/ou occupé!\n";
            }
        }
    }


    public function cancelBooking(){
        $c1 = true;
        while ($c1) {
            echo "Quel est le numéro de la chambre à libérer?(1 à " . count($this->rooms) . "): \n";
            $res = readline();

            if (($res > 0 && $res <= count($this->rooms)) && ($this->rooms[$res - 1]->getIsEmpty() == 1)) {
                $room = $this->rooms[$res - 1];
                $dateStart = $room->getDateStart();
                $dateEnd = $room->getDateEnd();
                $price = $room->getPrice();
                $client1 = $room->getCustomers()[0];


                $interval = $dateStart->diff($dateEnd);
                $intervalDate = $interval->format('%d');  //format numérique en nb de jours
                $prixTotal = $intervalDate * $price;
                $prixTotalTTC = $prixTotal * 1.2;

                $prixRemb = $prixTotalTTC * -1;

                $room->setIsEmpty(0);
                $room->setCustomers(array());
                $room->setDateStart('00-00-0000');
                $room->setDateEnd('00-00-0000');

                Tools::exportCSV($prixRemb,$client1);
                $c1 = false;
            }
            else{
                echo "taper un numéro de chambre valide et/ou occupé!\n";
            }
        }
    }

    public function createArrCustomers()
    {
        echo "Bienvenu dans le module de création des clients (attention: 2 adultes & 2 enfants maximum par chambre)\n";
        echo PHP_EOL;
        echo "Création du client principal (Adulte obligatoire): \n";
        $c1 = true;
        $cptA = 1;
        $cptE = 0;
        $customers = array();
        $mastercard = 0;
        $login = 0;
        $email = 0;
        while($c1){
            echo "Age: \n";
            $age = readline();
            if ($age <= 12){
                echo "impossible, il faut obligatoirement un adulte\n";
            }else{
                echo "Nom: \n";
                $nom = readline();
                echo "Prenom: \n";
                $prenom = readline();
                echo "Email: \n";
                $email = readline();
                echo "Login: \n";
                $login = readline();
                echo "Mastercard: \n";
                $mastercard = readline();

                $customers[] = new Customer($nom, $prenom, $age, $login, $email, $mastercard);
                $c1 = false;
            }
        }


        $c2 = true;
        while ($c2){
            echo "Avez vous des clients secondaires à rattaché?(oui/non): \n";
            $res = readline();
            switch ($res){
                case 'oui':
                    echo "Age: \n";
                    $age = readline();
                    if ($age > 12){
                        $cptA++;
                        if ($cptA > 2){
                            echo "ajout impossible, il y a dèja 2 adultes\n";
                        }else{
                            echo "Nom: \n";
                            $nom = readline();
                            echo "Prenom: \n";
                            $prenom = readline();

                            $customers[] = new Customer($nom, $prenom, $age, $login, $email, $mastercard);
                        }
                    }else{
                        $cptE++;
                        if ($cptE > 2){
                            echo "ajout impossible, il y a dèja 2 enfants\n";
                        }else{
                            echo "Nom: \n";
                            $nom = readline();
                            echo "Prenom: \n";
                            $prenom = readline();

                            $customers[] = new Customer($nom, $prenom, $age, $login, $email, $mastercard);
                        }
                    }
                    break;

                case 'non':
                    echo "ok, fin du module de création client\n";
                    $c2=false;
                    break;

                default:
                    echo "je n'ai pas compris votre choix, veuillez recommencer.\n";
                    break;
            }
        }
        return $customers;
    }

    /**
     * @return mixed
     */
    public function getNbRoomFree()
    {
        return $this->nbRoomFree;
    }

    /**
     * @param mixed $nbRoomFree
     */
    public function setNbRoomFree($nbRoomFree)
    {
        $this->nbRoomFree = $nbRoomFree;
    }

    /**
     * @return mixed
     */
    public function getNbRoomOccupied()
    {
        return $this->nbRoomOccupied;
    }

    /**
     * @param mixed $nbRoomOccupied
     */
    public function setNbRoomOccupied($nbRoomOccupied)
    {
        $this->nbRoomOccupied = $nbRoomOccupied;
    }

    /**
     * @return mixed
     */
    public function getNbRoomTotal()
    {
        return $this->nbRoomTotal;
    }

    /**
     * @param mixed $nbRoomTotal
     */
    public function setNbRoomTotal($nbRoomTotal)
    {
        $this->nbRoomTotal = $nbRoomTotal;
    }

    /**
     * @return mixed
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * @param mixed $worker
     */
    public function setWorker($worker)
    {
        $this->worker = $worker;
    }

    /**
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param mixed $rooms
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * @return mixed
     */
    public function getRoomsCVP()
    {
        return $this->roomsCVP;
    }

    /**
     * @param mixed $roomsCVP
     */
    public function setRoomsCVP($roomsCVP)
    {
        $this->roomsCVP = $roomsCVP;
    }

    /**
     * @return mixed
     */
    public function getRoomsCVJ()
    {
        return $this->roomsCVJ;
    }

    /**
     * @param mixed $roomsCVJ
     */
    public function setRoomsCVJ($roomsCVJ)
    {
        $this->roomsCVJ = $roomsCVJ;
    }

    /**
     * @return mixed
     */
    public function getRoomsCVO()
    {
        return $this->roomsCVO;
    }

    /**
     * @param mixed $roomsCVO
     */
    public function setRoomsCVO($roomsCVO)
    {
        $this->roomsCVO = $roomsCVO;
    }

    /**
     * @return mixed
     */
    public function getRoomsCVIO()
    {
        return $this->roomsCVIO;
    }

    /**
     * @param mixed $roomsCVIO
     */
    public function setRoomsCVIO($roomsCVIO)
    {
        $this->roomsCVIO = $roomsCVIO;
    }

    /**
     * @return mixed
     */
    public function getRoomsCDA()
    {
        return $this->roomsCDA;
    }

    /**
     * @param mixed $roomsCDA
     */
    public function setRoomsCDA($roomsCDA)
    {
        $this->roomsCDA = $roomsCDA;
    }

    /**
     * @return mixed
     */
    public function getRoomsExec()
    {
        return $this->roomsExec;
    }

    /**
     * @param mixed $roomsExec
     */
    public function setRoomsExec($roomsExec)
    {
        $this->roomsExec = $roomsExec;
    }

    /**
     * @return mixed
     */
    public function getRoomsAmb()
    {
        return $this->roomsAmb;
    }

    /**
     * @param mixed $roomsAmb
     */
    public function setRoomsAmb($roomsAmb)
    {
        $this->roomsAmb = $roomsAmb;
    }

    /**
     * @return mixed
     */
    public function getRoomsRoyale()
    {
        return $this->roomsRoyale;
    }

    /**
     * @param mixed $roomsRoyale
     */
    public function setRoomsRoyale($roomsRoyale)
    {
        $this->roomsRoyale = $roomsRoyale;
    }

    /**
     * @return mixed
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param mixed $revenue
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;
    }


}