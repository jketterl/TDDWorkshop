<?php
namespace Json;

class Codec implements CodecInterface
{
    public function encode($data)
    {
        return json_encode($data);
    }
    
    public function decode($data)
    {
        return json_decode($data);
    }
}