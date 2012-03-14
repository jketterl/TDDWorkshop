<?php
namespace Json;

use Format\FormatInterface;

class Codec implements FormatInterface
{
    protected $_utf;
    
    protected function getUtf()
    {
        if (!isset($this->_utf)) {
            $this->_utf = new UtfEncoder();
        };
        return $this->_utf;
    }
    
    public function encode($data)
    {
        return json_encode($this->getUtf()->encode($data));
    }
    
    public function decode($data)
    {
        return json_decode($data);
    }
    
    public function getFileExtension()
    {
        return 'json';
    }
}