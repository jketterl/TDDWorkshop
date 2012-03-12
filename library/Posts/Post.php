<?php
namespace Posts;

class Post
{
    public $text;

    /**
     * Ein moeglicher Textvalidator
     * 
     * @var \Validator\ValidatorInterface
     */
    private $_textValidator;
    
    public function setText($text)
    {
        if (!is_null($this->_textValidator)) {
            $isValid = $this->_textValidator->isValid($text);
            if (!$isValid) {
                throw new \InvalidArgumentException('Keine Schimpfworte!');
            }
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
    
    public function setTextValidator(\Validator\ValidatorInterface $validator)
    {
        $this->_textValidator = $validator;
    }
}