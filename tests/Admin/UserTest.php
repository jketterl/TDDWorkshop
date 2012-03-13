<?php
namespace Admin;

/**
 * 
 * @author djungowski
 * 
 * @covers Posts\User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testGetId()
    {
        $user = new User();
        $user->setId(5);
        self::assertSame(5, $user->getId());
    }
    
    public function testGetLogin()
    {
        $user = new User();
        $user->setLogin('bernd-brot');
        self::assertSame('bernd-brot', $user->getLogin());
    }
    
    public function testGetName()
    {
        $user = new User();
        $user->setName('Bernd das Brot');
        self::assertSame('Bernd das Brot', $user->getName());
    }
    
    public function testSetPassword()
    {
        $user = new User();
        $pwdPlain = 'ichL1ebekast3nbrot';
        $pwdHashed = sha1($pwdPlain);
        $user->setPassword($pwdPlain);
        self::assertSame($pwdHashed, $user->getPassword());
    }
}