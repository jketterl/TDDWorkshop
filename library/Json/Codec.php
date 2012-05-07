<?php
namespace Json;

use Format\FormatInterface;

class Codec implements FormatInterface
{
    public function encode($data)
    {
        return json_encode($data);
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