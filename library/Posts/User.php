<?php
namespace Posts;

class User
{
    public $id;
    public $login;
    public $name;
    
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
}