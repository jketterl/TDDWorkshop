<?php
namespace Json;
require_once(__DIR__ . '/../../bootstrap.php');

class UtfEncoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function returns an ISO8859-1 string that you can use to test whether your
     * encoder correctly transforms data into UTF8.
     *  
     * @return string
     */
    public function getIsoString()
    {
        return chr(228) . chr(246) . chr(252);
    }
    
    /**
     * This function returns the UTF8 string corresponding to the one returned by getIsoString().
     * 
     * @return string
     */
    public function getUtf8String()
    {
        return utf8_encode($this->getIsoString());
    }
    
    public function testConvertsToUtf()
    {
        $encoder = new UtfEncoder();
        
        self::assertEquals($this->getUtf8String(), $encoder->encode($this->getIsoString()));
    }
    
    public function testEncodesArray()
    {
        $input = Array(
            $this->getIsoString()
        );
        
        $expected = Array(
            $this->getUtf8String()
        );
        
        $encoder = new UtfEncoder();
        
        self::assertEquals($expected, $encoder->encode($input));
    }
    
    public function testEncodesObject()
    {
        $input = new \stdClass();
        $input->key = $this->getIsoString();
        
        $expected = new \stdClass();
        $expected->key = $this->getUtf8String();
        
        $encoder = new UtfEncoder();
        self::assertEquals($expected, $encoder->encode($input));
    }
    
    public function testPassesIntegers()
    {
        $input = 42;
        $encoder = new UtfEncoder();
        self::assertEquals(42, $encoder->encode($input));
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage cannot encode variable type
     */
    public function testThrowsExceptionOnInvalidType()
    {
        $encoder = new UtfEncoder();
        $encoder->encode(NULL);
    }
}
