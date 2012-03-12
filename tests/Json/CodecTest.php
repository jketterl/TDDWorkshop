<?php
namespace Json;

/**
 * @author jketterl
 * 
 * @cgroup encoders
 * @group json
 * 
 * @covers Json\Codec
 */
class CodecTest extends \PHPUnit_Framework_TestCase
{
    public function testEncodesArray()
    {
        $encoder = new Codec();
        $array = Array(
            'text1',
            'text2',
            'text3'
        );
        
        $output = $encoder->encode($array);
        self::assertEquals('["text1","text2","text3"]', $output);
    }
    
    public function testEncodesObject()
    {
        $encoder = new Codec();
        $object = new \stdClass();
        $object->foo = 'bar';
        $object->bla = 'blubb';
        
        $output = $encoder->encode($object);
        self::assertEquals('{"foo":"bar","bla":"blubb"}', $output);
    }
    
    // IMPLEMENT LESSON 4 TESTS HERE!
}