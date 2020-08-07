<?php
require_once  "Person.class.php";

class Customer extends Person
{
    private $email;

    public function __construct(String $nom, String $prenom, int $age, String $login, String $email)
    {
        parent::__construct($nom, $prenom, $age, $login);
        $this->email = $email;

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


}