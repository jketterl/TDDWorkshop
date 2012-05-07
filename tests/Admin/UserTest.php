<?php
namespace Admin;

/**
 * 
 * @author djungowski
 * 
 * @covers Admin\User
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
    
    public function testLoad()
    {
        $user = new User();
        $data = array(
            0,
            'Default User',
            '4be30d9814c6d4e9800e0d2ea9ec9fb00efa887b'
        );
        $user->load($data);
        self::assertEquals($data[0], $user->getId());
        self::assertEquals($data[1], $user->getName());
        self::assertEquals($data[2], $user->getPassword());
    }
}