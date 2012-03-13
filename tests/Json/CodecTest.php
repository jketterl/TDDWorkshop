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
        $encoder = new Codec();
        $array = Array(
            'text1',
            'text2',
            'text3'
        );
        
        $output = $encoder->encode($array);
        self::assertInternalType('string', $output);
        self::assertEquals('["text1","text2","text3"]', $output);
    }
    
    public function testEncodesObject()
    {
        $encoder = new Codec();
        $object = new \stdClass();
        $object->foo = 'bar';
        $object->bla = 'blubb';
        
        $output = $encoder->encode($object);
        self::assertInternalType('string', $output);
        self::assertEquals('{"foo":"bar","bla":"blubb"}', $output);
    }
    
    public function testDecodesArray()
    {
        $decoder = new Codec();
        
        $output = $decoder->decode('["text1","text2","text3"]');
        
        self::assertInternalType('array', $output);
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
        
        self::assertInternalType('object', $output);
        self::assertEquals($object, $output);
    }
}