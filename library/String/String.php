<?php
namespace String;

class String
{
    protected $_value;
    
    public function __construct($input)
    {
        $this->_value = $input;
    }
    
    public function getEllipsis()
    {
        // IMPLEMENT LESSON 3 CODE HERE
    }
    
    public function __toString()
    {
        return $this->getEllipsis($this->_value);
    }
}