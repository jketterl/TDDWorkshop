<?php
namespace Validator;

/**
 * @author djungowski
 * 
 * @group profanity
 * @group validation
 * 
 * @covers Validator\Profanity
 */
class ProfanityTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateTrue()
    {
        $validator = new Profanity();
        self::assertTrue($validator->isValid('Dies ist ein sozial verträglicher Text'));
    }
    
    /**
     * @expectedException Validator\ValidatorException
     * @expectedExceptionMessage contains blacklisted words
     */
    public function testThrowsExceptionOnInvalidWord()
    {
        $validator = new Profanity();
        $validator->isValid('fuck');
    }
    
    /**
     * @expectedException Validator\ValidatorException
     * @expectedExceptionMessage contains blacklisted words
     */
    public function testThrowsExceptionOnInvalidWordInSentence()
    {
        $validator = new Profanity();
        $validator->isValid('Dies ist ein fuck Lauftext');
    }
}