<?php
namespace Json;

/**
 * @author jketterl
 * 
 * @group encoders
 * @group json
 * 
 * @covers Json\Codec
 */
class CodecTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $encoder = new Codec();
        self::assertInstanceOf('Json\CodecInterface', $encoder);
    }
    
    public function testEncodesArray()
    {
        $json = new Codec();
        $array = Array(
            'das ist ein Test'
        );
        
        $output = $json->encode($array);
        self::assertEquals(
            '["das ist ein Test"]',
            $output
        );
    }
    
    public function testEncodesObject()
    {
        $json = new Codec();
        $object = new \stdClass();
        $object->name = 'Hans Wurst';
        
        $output = $json->encode($object);
        self::assertEquals(
            '{"name":"Hans Wurst"}',
            $output
        );
    }
    
    public function testDecodesArray()
    {
        $decoder = new Codec();
        
        $output = $decoder->decode('["text1","text2","text3"]');
        
        self::assertEquals(
            Array(
                'text1',
                'text2',
                'text3'
            ),
            $output
        );
    }
    
    public function testDecodesObject()
    {
        $decoder = new Codec();
        
        $output = $decoder->decode('{"foo":"bar","bla":"blubb"}');
        
        $object = new \stdClass();
        $object->foo = 'bar';
        $object->bla = 'blubb';
        self::assertEquals($object, $output);
    }
}
