<?php
namespace Posts;

class User
{
    public $id;
    public $login;
    public $name;
    public $password;
    
    /**
     * Validator, um bei Bedarf das Passwort zu validieren
     * 
     * @var \Validator\ValidatorInterface
     */
    private $_passwordValidator;
    
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
        if (isset($this->_passwordValidator)) {
            $isValidPwd = $this->_passwordValidator->isValid($password);
            if (!$isValidPwd) {
                throw new \InvalidArgumentException('Password entspricht nicht den Mindestkriterien');
            }
        }
        $this->password = sha1($password);
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPasswordValidator(\Validator\ValidatorInterface $validator)
    {
        $this->_passwordValidator = $validator;
    }
}