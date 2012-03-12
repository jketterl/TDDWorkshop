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
    
    // IMPLEMENT LESSON 3 TESTS HERE
}