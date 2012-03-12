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
	public function testIsValidTrue()
	{
		$validator = new Profanity();
		self::assertTrue($validator->isValid('Dies ist ein sozial verträglicher Text'));
	}
	
	public function testIsValidFalse()
	{
		$validator = new Profanity();
		self::assertFalse($validator->isValid('fuck'));
		self::assertFalse($validator->isValid('shit'));
		self::assertFalse($validator->isValid('Mario Barth'));
		self::assertFalse($validator->isValid('Dies ist ein fuck Lauftext'));
		self::assertFalse($validator->isValid('fuck ist shit und überhaupt!'));
	}
}