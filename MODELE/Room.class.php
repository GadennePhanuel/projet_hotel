<?php


class Room
{
    private $size;
    private $type;
    private $price;
    private $options = array();
    private $optionList;
    private $view;
    private $isEmpty = 0;
    private $dateStart;
    private $dateEnd;
    private $customers = array();
    private $customersList;
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
            $this->optionList = $this->optionList . " " . $option;
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
            foreach ($this->customers as $customer){
                $this->customersList = $this->customersList." ". $customer;
            }
            return "Chambre n°".$this->id."\n".
                    "Type: ".$this->type."\n".
                    "Vue: ". $this->view."\n".
                    "Taille: ". $this->size."\n".
                    "Options: ". $this->optionList."\n".
                    "Prix de la nuit: ". $this->price."\n".
                    "Statut: occupé\n".
                    "Occupant: ". $this->customersList."\n".
                    "Date de réservation: ".$this->dateStart." au ".$this->dateEnd."\n";
        }else {
            return "Chambre n°".$this->id."\n".
                    "Type: ".$this->type."\n".
                    "Vue: ". $this->view."\n".
                    "Taille: ". $this->size."\n".
                    "Options: ". $this->optionList."\n".
                    "Prix de la nuit: ". $this->price."\n".
                    "Statut: libre\n";
        }
    }
}