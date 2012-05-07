<?php
namespace Admin;

class User
{
    public $id;
    public $login;
    public $name;
    public $password;
        
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLogin()
    {
        return $this->login;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * User "einrichten" mit Daten aus Benutzerdatei
     * 
     * Array an Stelle 0: User ID
     * Array an Stelle 1: Benutzername
     * Array an Stelle 2: Passwort
     * 
     * @param Array $userData
     */
    public function load($userData)
    {
        $this->id = $userData[0];
        $this->name = $userData[1];
        $this->password = $userData[2];
    }
}