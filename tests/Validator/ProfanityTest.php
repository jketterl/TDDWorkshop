<?php
namespace Validator;

/**
 * @author djungowski
 * @covers Validator\Profanity
 */
class ProfanityTest extends \PHPUnit_Framework_TestCase
{
	public function testValidateTrue()
	{
		$validator = new Profanity();
		$this->assertTrue($validator->isValid('Dies ist ein sozial verträglicher Text'));
	}
	
	public function testValidateFalse()
	{
		$validator = new Profanity();
		$this->assertFalse($validator->isValid('fuck'));
		$this->assertFalse($validator->isValid('shit'));
		$this->assertFalse($validator->isValid('Mario Barth'));
		$this->assertFalse($validator->isValid('Dies ist ein fuck Lauftext'));
		$this->assertFalse($validator->isValid('fuck ist shit und überhaupt!'));
	}
}