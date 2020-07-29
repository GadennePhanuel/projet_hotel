<?php
require_once  "Person.class.php";

class Customer extends Person
{
    private $email;
    private $mastercard;

    public function __construct(String $nom, String $prenom, int $age, String $login, String $email, int $mastercard)
    {
        parent::__construct($nom, $prenom, $age, $login);
        $this->email = $email;
        $this->mastercard = $mastercard;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getMastercard()
    {
        return $this->mastercard;
    }

    /**
     * @param int $mastercard
     */
    public function setMastercard($mastercard)
    {
        $this->mastercard = $mastercard;
    }


}