<?php
namespace String;

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function testPassesShortString()
    {
        $message = 'this is a short string';
        $string = new String($message);
        self::assertEquals($message, $string->getEllipsis());
    }
    
    public function testShortensLongString()
    {
        $string = new String(
            'this is particularly long string. it should be shortened to one hundred and twenty ' .
            'chars by the method, and should be padded with three dots at the end.'
        );
        self::assertEquals(120, strlen($string->getEllipsis()));
    }
}