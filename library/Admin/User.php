<?php
namespace Admin;

use Validator\Password;

use Validator\ValidatorInterface;

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
    
    public function getPasswordValidator()
    {
        if (!isset($this->_passwordValidator)) {
            $this->_passwordValidator = new Password();
        }
        return $this->_passwordValidator;
    }
    
    public function setPasswordValidator(ValidatorInterface $validator)
    {
        $this->_passwordValidator = $validator;
    }
    
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
        if (!$this->getPasswordValidator()->isValid($password)) {
            throw new \InvalidArgumentException('new password is not secure enough');
        }
        $this->password = sha1($password);
    }
    
    public function getPassword()
    {
        return $this->password;
    }
}