<?php
require_once "Person.class.php";

class Worker extends Person
{
    private $password;

   public function __construct(String $nom, String $prenom, int $age, String $login, String $password)
   {
       parent::__construct($nom, $prenom, $age, $login);
       $this->password = $password;
   }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}