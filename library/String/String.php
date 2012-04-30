<?php
namespace String;

class String
{
    protected $_value;
    
    protected $_maxLength = 120;
    
    public function __construct($input)
    {
        $this->_value = $input;
    }
    
    public function getEllipsis()
    {
        if (strlen($this->_value) <= $this->_maxLength) return $this->_value;
        return substr($this->_value, 0, $this->_maxLength - 3) . '...';
    }
    
    public function __toString()
    {
        return $this->getEllipsis($this->_value);
    }
}