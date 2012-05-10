<?php
namespace Posts;

use Storage\StorageInterface;

use Validator\ValidatorInterface;

use Validator\Profanity;

class Post
{
    public $text;
    
    public $userid;

    /**
     * Ein moeglicher Textvalidator
     * 
     * @var \Validator\ValidatorInterface
     */
    private $_textValidator;
    
    public function getValidator()
    {
        if (!isset($this->_textValidator)) {
            $this->_textValidator = new Profanity();
        }
        return $this->_textValidator;
    }
    
    public function setValidator(ValidatorInterface $validator)
    {
        $this->_textValidator = $validator;
        return $this;
    }
    
    public function setText($text)
    {
        $isValid = $this->getValidator()->isValid($text);
        if (!$isValid) {
            throw new \InvalidArgumentException('Keine Schimpfworte!');
        }
        $this->text = $text;
        return $this;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function setUserId($userId)
    {
        $this->userid = $userId;
    }
    
    public function getUserId()
    {
        return $this->userid;
    }
    
    public function __toString()
    {
        return $this->getText();
    }
    
    public function setStorage(StorageInterface $storage)
    {
        $this->_storage = $storage;
        return $this;
    }
    
    public function getStorage()
    {
        return $this->_storage;
    }
    
    public function save()
    {
        $this->getStorage()->store($this);
    }
}
