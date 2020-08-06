<?php


class Room
{
    private $size;
    private $type;
    private $price;
    private $options = array();
    private $optionList;  //string
    private $view;
    private $isEmpty = 0;
    private $dateStart;
    private $dateEnd;
    private $customers = array();
    private $customersList;   //string
    private $id = 0;
    private static $countRoom = 0;


    public function __construct(String $type,String $size,String $view,int $price,array $options)
    {
        $this->type = $type;
        $this->size = $size;
        $this->view = $view;
        $this->price = $price;
        $this->options = $options;
        self::$countRoom++;
        $this->id = self::$countRoom;

        //on parcours le tableau des options et on fait une string de tout son contenu (sert à la fonction d'affichage notamment)
        foreach ($this->options as $option){
            $this->optionList = $this->optionList . ", " . $option;
        }

    }

    /**
     * @return string
     * fonction d'affichage de toutes les infos générales de la chambre
     */
    public function displayRoom()
    {
        //si la chambre est occupé on inclus les infos général de ses occupants, et les dates de réservation
        if ($this->isEmpty == 1) {
            //si la chambre est occupé il y a forcément 1 ou plusieurs occupant, on parcours donc le tableau et on en fait un string pour l'affichage

            if (!isset($this->customersList) && empty($this->customersList)){
                foreach ($this->customers as $customer) {

                    $this->customersList = $this->customersList . " " . $customer->getNom() . " " . $customer->getPrenom() . " " . $customer->getAge() . " - ";

                }
            }

            $ch = "Chambre n°".$this->id;
            $ty = "Type: ".$this->type;
            $vu = "Vue: ". $this->view;
            $taille = "Taille: ". $this->size;
            $opt = "Options: ". $this->optionList;
            $prix = "Prix de la nuit: ". $this->price;
            $stat = "Statut: occupé";
            $client = "Occupant: ". $this->customersList;
            $dateReserv = "Date de réservation: ".$this->dateStart->format('d-m-Y')." au ".$this->dateEnd->format('d-m-Y');

            $result = array($ch, $ty, $vu, $taille, $opt, $prix, $stat, $client, $dateReserv);

            return $result;

        }else {
            $ch = "Chambre n°".$this->id;
            $ty = "Type: ".$this->type;
            $vu = "Vue: ". $this->view;
            $taille = "Taille: ". $this->size;
            $opt = "Options: ". $this->optionList;
            $prix = "Prix de la nuit: ". $this->price;
            $stat = "Statut: libre";

            $result = array($ch, $ty, $vu, $taille, $opt, $prix, $stat);

            return $result;
        }
    }




    /**
     * @return String
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param String $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param String $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getOptionList()
    {
        return $this->optionList;
    }

    /**
     * @param string $optionList
     */
    public function setOptionList($optionList)
    {
        $this->optionList = $optionList;
    }

    /**
     * @return String
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param String $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return int
     */
    public function getIsEmpty()
    {
        return $this->isEmpty;
    }

    /**
     * @param int $isEmpty
     */
    public function setIsEmpty($isEmpty)
    {
        $this->isEmpty = $isEmpty;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param mixed $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return array
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * @param array $customers
     */
    public function setCustomers($customers)
    {
        $this->customers = $customers;
    }

    /**
     * @return mixed
     */
    public function getCustomersList()
    {
        return $this->customersList;
    }

    /**
     * @param mixed $customersList
     */
    public function setCustomersList($customersList)
    {
        $this->customersList = $customersList;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public static function getCountRoom()
    {
        return self::$countRoom;
    }

    /**
     * @param int $countRoom
     */
    public static function setCountRoom($countRoom)
    {
        self::$countRoom = $countRoom;
    }

}