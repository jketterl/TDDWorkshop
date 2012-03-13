<?php
namespace Posts;

use Validator\ValidatorInterface;

use Validator\Profanity;

class Post
{
    public $text;

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
    
    public function __toString()
    {
        return $this->getText();
    }
}
