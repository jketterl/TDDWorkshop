<?php
namespace Json;

class CodecTest extends \PHPUnit_Framework_TestCase
{
    public function testEncodesArray()
    {
        $json = new Codec();
        $array = Array(
            'das ist ein Test'
        );
        
        self::assertEquals(
            '["das ist ein Test"]',
            $json->encode($array)
        );
    }
    
    public function testEncodesObject()
    {
        $json = new Codec();
        $object = new \stdClass();
        $object->name = 'Hans Wurst';
        
        self::assertEquals(
            '{"name":"Hans Wurst"}',
            $json->encode($object)
        );
    }
    
    // IMPLEMENT LESSON 4 TESTS HERE!
}
