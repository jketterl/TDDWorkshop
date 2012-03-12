<?php
namespace Json;
require_once(__DIR__ . '/../../bootstrap.php');

class CodecTest extends \PHPUnit_Framework_TestCase
{
    public function testEncodesArray()
    {
        $encoder = new Codec();
        $array = Array(
            'das ist ein Test'
        );
        
        $output = $encoder->encode($array);
        self::assertEquals('["das ist ein Test"]', $output);
    }
    
    public function testEncodesObject()
    {
        $encoder = new Codec();
        $object = new \stdClass();
        $object->name = 'Hans Wurst';
        
        $output = $encoder->encode($object);
        self::assertEquals('{"name":"Hans Wurst"}', $output);
    }
}