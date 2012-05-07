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
    
    /**
     * This function will return a mocked validator object that will always respond with whatever you passed as the
     * $return parameter.

     * @param boolean $return
     */
    protected function getMockedValidator($return)
    {
        $mock = $this->getMock('Validator\ValidatorInterface');
        $mock->expects($this->any())->method('isValid')->will($this->returnValue($return));
        return $mock;
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage not secure enough
     */
    public function testRejectsPasswordWhenInvalid()
    {
        $user = new User();
        $user->setPasswordValidator($this->getMockedValidator(false));
        $user->setPassword('ambiguous');
    }
    
    public function testAcceptsPasswordWhenValid()
    {
        $user = new User();
        $user->setPasswordValidator($this->getMockedValidator(true));
        $password = 'ambiguous';
        $user->setPassword($password);
        self::assertEquals(sha1($password), $user->getPassword());
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