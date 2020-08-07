<?php
require_once "Worker.class.php";
require_once "Room.class.php";

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
    private $arrCsv;
    private static $revenue;
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

    
    public function authentificationPassword($log,$mdp)
    {
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
        $allRoom = array();
        //création d'un tableau contenant toutes les chambres occupés
        $roomsBooked =array();
        foreach ($this->rooms as $room){
            if($room->getIsEmpty() == 1){
                $roomsBooked[] = $room;
            }
        }
        if (isset($roomsBooked) && !empty($roomsBooked)){
            foreach ($roomsBooked as $room){
                $roomDisplay = $room->displayRoom();
                $allRoom[] = $roomDisplay;
            }
            return $allRoom;
        }else{
            return "Aucune réservation dans l'hotel";
        }
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
        $customerRoom = [];
        foreach ($this->rooms as $room) {
            if ($room->getIsEmpty() == 1) {
                $customers = $room->getCustomers();
                foreach ($customers as $customer) {
                    $login = $customer->getLogin();

                    if ($login == $log) {
                        $tmp1 = $room->getDateStart();
                        $tmp2 = $room->getDateEnd();

                        return $customerRoom = [
                            "Prenom: " => $customer->getPrenom(),
                            "Nom" =>  $customer->getNom(),
                            "Numéro de chambre: " => $room->getId(),
                            "Type de chambre: " => $room->getType(),
                            "Date d'entrée: " => $tmp1->format('d-m-Y'),
                            "Date de sortie: " => $tmp2->format('d-m-Y')
                        ];
                    }
                }
            }
        }
    }

    public function displayRoomType(){
        $cptCVP = 0;
        $arrayCVP = [];
        foreach ($this->roomsCVP as $room){
            if($room->getisEmpty() ==0){
                $cptCVP ++;
            }
        }
        if ($cptCVP > 0){
            $arrayCVP = [
                "Chambre 1: " => $this->roomsCVP[0]->getType(),
                "Vue : " => $this->roomsCVP[0]->getView(),
                "Surface: " => $this->roomsCVP[0]->getSize(),
                "Options :" => $this->roomsCVP[0]->getOptionList(),
                "Prix: " => $this->roomsCVP[0]->getPrice()
            ];

        }

        $cptCVJ = 0;
        $arrayCVJ = [];
        foreach ($this->roomsCVJ as $room){
            if($room->getisEmpty() ==0){
                $cptCVJ ++;
            }
        }
        if ($cptCVJ > 0){
            $arrayCVJ = [
                "Chambre 2: " => $this->roomsCVJ[0]->getType(),
                "Vue : " => $this->roomsCVJ[0]->getView(),
                "Surface: " => $this->roomsCVJ[0]->getSize(),
                "Options :" => $this->roomsCVJ[0]->getOptionList(),
                "Prix: " => $this->roomsCVJ[0]->getPrice()
            ];
        }

        $cptCVO = 0;
        $arrayCVO = [];
        foreach ($this->roomsCVO as $room){
            if($room->getisEmpty() ==0){
                $cptCVO ++;
            }
        }
        if ($cptCVO > 0){
            $arrayCVO =[
                "Chambre 3: " => $this->roomsCVO[0]->getType(),
                "Vue : " => $this->roomsCVO[0]->getView(),
                "Surface: " => $this->roomsCVO[0]->getSize(),
                "Options :" => $this->roomsCVO[0]->getOptionList(),
                "Prix: " => $this->roomsCVO[0]->getPrice()
                ];

        }

        $cptCVIO = 0;
        $arrayCVIO = [];
        foreach ($this->roomsCVIO as $room){
            if($room->getisEmpty() ==0){
                $cptCVIO ++;
            }
        }
        if ($cptCVIO > 0){
            $arrayCVIO = [
                "Chambre 4: " => $this->roomsCVIO[0]->getType(),
                "Vue : " => $this->roomsCVIO[0]->getView(),
                "Surface: " => $this->roomsCVIO[0]->getSize(),
                "Options :" => $this->roomsCVIO[0]->getOptionList(),
                "Prix: " => $this->roomsCVIO[0]->getPrice()
            ];
        }

        $cptCDA = 0;
        $arrayCDA = [];
        foreach ($this->roomsCDA as $room){
            if($room->getisEmpty() ==0){
                $cptCDA ++;
            }
        }
        if ($cptCDA > 0){
            $arrayCDA = [
                "Chambre 5: " => $this->roomsCDA[0]->getType(),
                "Vue : " => $this->roomsCDA[0]->getView(),
                "Surface: " => $this->roomsCDA[0]->getSize(),
                "Options :" => $this->roomsCDA[0]->getOptionList(),
                "Prix: " => $this->roomsCDA[0]->getPrice()
            ];
        }

        $cptExec = 0;
        $arrayCptExec = [];
        foreach ($this->roomsExec as $room){
            if($room->getisEmpty() ==0){
                $cptExec ++;
            }
        }
        if ($cptExec > 0){
            $arrayCptExec = [
                "Chambre 6: " => $this->roomsExec[0]->getType(),
                "Vue : " => $this->roomsExec[0]->getView(),
                "Surface: " => $this->roomsExec[0]->getSize(),
                "Options :" => $this->roomsExec[0]->getOptionList(),
                "Prix: " => $this->roomsExec[0]->getPrice()
            ];
        }

        $cptAmb = 0;
        $arrayCptAmb = [];
        foreach ($this->roomsAmb as $room){
            if($room->getisEmpty() ==0){
                $cptAmb ++;
            }
        }
        if ($cptAmb > 0){
            $arrayCptAmb = [
                "Chambre 7: " => $this->roomsAmb[0]->getType(),
                "Vue : " => $this->roomsAmb[0]->getView(),
                "Surface: " => $this->roomsAmb[0]->getSize(),
                "Options :" => $this->roomsAmb[0]->getOptionList(),
                "Prix: " => $this->roomsAmb[0]->getPrice()
            ];
        }

        $cptRoyale = 0;
        $arrayCptRoyale = [];
        foreach ($this->roomsRoyale as $room){
            if($room->getisEmpty() ==0){
                $cptRoyale ++;
            }
        }
        if ($cptRoyale > 0){
            $arrayCptRoyale = [
                "Chambre 8: " => $this->roomsRoyale[0]->getType(),
                "Vue : " => $this->roomsRoyale[0]->getView(),
                "Surface: " => $this->roomsRoyale[0]->getSize(),
                "Options :" => $this->roomsRoyale[0]->getOptionList(),
                "Prix: " => $this->roomsRoyale[0]->getPrice()
            ];
        }
        return $res = [$arrayCVP, $arrayCVJ, $arrayCVO, $arrayCVIO, $arrayCDA, $arrayCptExec, $arrayCptAmb, $arrayCptRoyale];
    }
    public function booking ($dateStart,$dateEnd,$customer,$typechoose){

        switch ($typechoose){
            case '1':
                $typechoose = "Chambre Vue Piscine";
                break;
            case '2':
                $typechoose = "Chambre Vue Jardin";
                break;
            case '3':
                $typechoose = "Chambre Vue Océan";
                break;
            case '4':
                $typechoose = "Chambre vue imprenable sur l'océan";
                break;
            case '5':
                $typechoose = "Suite CDA";
                break;
            case '6':
                $typechoose = "Suite Executive";
                break;
            case '7':
                $typechoose = "Suite Ambassadeur";
                break;
            case '8':
                $typechoose = "Suite Royale";
                break;

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
        $dateStart = new DateTime($dateStart);
        $dateEnd = new DateTime($dateEnd);

        $roomChoose->setCustomers($customer);
        $roomChoose->setIsEmpty(1);
        $roomChoose->setDateStart($dateStart);
        $roomChoose->setDateEnd($dateEnd);


        return $roomChoose;
    }

    public static function paiement($room, $cb){
        self::$nbPaiement++;
        $numOfFacture = self::$nbPaiement;

        $dateStart = $room->getDateStart();
        $dateEnd = $room->getDateEnd();
        $interval = $dateStart->diff($dateEnd);
        $intervalDate = $interval->format('%d');  //format numérique en nb de jours
        $price = $room->getPrice();
        $prixTotal = $intervalDate * $price;
        $prixTotalTTC = $prixTotal * 1.2;

        $CA = self::$revenue;
        $CA = $CA + $prixTotalTTC;
        self::$revenue = $CA;

        $client1 = $room->getCustomers()[0];



        Tools::exportCSV($prixTotalTTC,$client1, $cb);
        Tools::facture($client1, $prixTotal, $room, $numOfFacture, $cb);

    }


    public function displayRoomsBookedSimple(){
        //création d'un tableau contenant toutes les chambres occupés
        $roomsBooked =array();
        foreach ($this->rooms as $room){
            if($room->getIsEmpty() == 1){
                $numRoom = $room->getId();
                $clients = $room->getCustomers();
                $name = $clients[0]->getNom();
                $firstName = $clients[0]->getPrenom();

                $roomsBooked[] = array($numRoom, $name, $firstName);
            }
        }
        if (isset($roomsBooked) && !empty($roomsBooked)){
            return $roomsBooked;
        }else{
            return "pas de chambre occupé";
        }
    }

    public function editBooking($numRoom, $newDateStart, $newDateEnd){
            $newDateStart = new DateTime($newDateStart);
            $newDateEnd = new DateTime($newDateEnd);

            if (($numRoom > 0 && $numRoom <= count($this->rooms)) && ($this->rooms[$numRoom-1]->getIsEmpty() == 1)){
                self::$nbPaiement++;
                $numOfFacture = self::$nbPaiement;
                $room = $this->rooms[$numRoom-1];

                $dateStart = $room->getDateStart();
                $dateEnd = $room->getDateEnd();
                $interval = $dateStart->diff($dateEnd);
                $intervalDate = $interval->format('%d');  //format numérique en nb de jours
                $price = $room->getPrice();
                $prixTotal = $intervalDate * $price;
                $prixTotalTTC = $prixTotal * 1.2;


                $room->setDateStart($newDateStart);

                $room->setDateEnd($newDateEnd);

                $interval = $newDateStart->diff($newDateEnd);
                $intervalDate = $interval->format('%d');  //format numérique en nb de jours
                $newPrixTotal = $intervalDate * $price;
                $newPrixTotalTTC = $newPrixTotal * 1.2;

                $prixDiff = $newPrixTotalTTC - $prixTotalTTC;


                $client1 = $room->getCustomers()[0];


                return array($room, $client1, $prixDiff, $numOfFacture);
            }
    }

    public function freeARoom($res)
    {

            if (($res > 0 && $res <= count($this->rooms)) && ($this->rooms[$res - 1]->getIsEmpty() == 1)) {
                $room = $this->rooms[$res - 1];
                $room->setIsEmpty(0);
                $room->setCustomers(array());
                $room->setDateStart('00-00-0000');
                $room->setDateEnd('00-00-0000');

                return $room;

            }


    }


    public function cancelBooking($res){

            $array = [];

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

            }
            $array = [$room, $client1, $prixRemb];
            return $array;

    }

    public function createArrCustomers($nom, $prenom, $age, $login, $email)
    {

        $customer= new Customer($nom, $prenom, $age, $login, $email);

        return $customer;
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