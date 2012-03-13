<?php
namespace Validator;

/**
 * Mindestanforderungen an ein Passwort:
 *  - Kleinbuchstaben
 *  - Grossbuchstaben
 *  - Zahlen
 *  - Mind. 8 Zeichen lang
 *
 * @author djungowski
 * 
 * @group validation
 * @group password
 *
 */
class PasswordTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $pass = new Password();
        $this->assertInstanceOf('Validator\ValidatorInterface', $pass);
    }
    
    public function testValidPassword()
    {
        $pass = new Password();
        self::assertTrue($pass->isValid('einVal1desPas5wort'));
    }
    
    public function testInvalidPasswordWithMissingNumber()
    {
        $pass = new Password();
        self::assertFalse($pass->isValid('keinValidesPasswort'));
    }
    
    public function testInvalidPasswordWithMissingCapitalLetter()
    {
        $pass = new Password();
        self::assertFalse($pass->isValid('keinval1despas5wort'));
    }
    
    public function testInvalidPasswordWithMissingLowerCaseLetter()
    {
        $pass = new Password();
        self::assertFalse($pass->isValid('KEINVAL1DESPAS5WORT'));
    }
    
    public function testInvalidPasswordOnlyNumbers()
    {
        $pass = new Password();
        self::assertFalse($pass->isValid('12345678'));
    }
    
    /**
     * Minimum: 8 Zeichen
     * 
     */
    public function testPasswordTooShort()
    {
        $pass = new Password();
        self::assertFalse($pass->isValid('zuKur5'));
    }
}