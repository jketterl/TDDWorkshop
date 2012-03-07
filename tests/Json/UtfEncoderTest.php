<?php
namespace Json;

class UtfEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testConvertsToUtf()
    {
        $input = 'äöü';
        // this file is in UTF-8, so in order to have ISO input we need to apply utf8_decode first.
        
        $iso = utf8_decode($input);
        
        $encoder = new UtfEncoder();
        
        self::assertEquals($input, $encoder->encode($iso));
    }
    
    public function testEncodesArray()
    {
        $input = Array(
            utf8_decode('äöü')
        );
        
        $encoder = new UtfEncoder();
        
        self::assertEquals(Array('äöü'), $encoder->encode($input));
    }
    
    public function testEncodesObject()
    {
        $input = new \stdClass();
        $input->key = utf8_decode('äöü');
        
        $expected = new \stdClass();
        $expected->key = 'äöü';
        
        $encoder = new UtfEncoder();
        self::assertEquals($expected, $encoder->encode($input));
    }
}