<?php
namespace Json;

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
}