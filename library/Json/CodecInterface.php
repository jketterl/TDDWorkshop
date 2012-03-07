<?php
namespace Json;

interface CodecInterface
{
    /**
     * Encode a given PHP variable into JSON.
     * 
     * Parameters may be arrays, objects, strings, integers
     * 
     * @param mixed $data
     */
    public function encode($data);
    
    /**
     * Decode a given JSON string into PHP objects.
     * 
     * @param string $data
     */
    public function decode($data);
}