<?php
namespace Posts;

/**
 * 
 * @author djungowski
 * 
 * @covers Posts\User
 */
class UserText extends \PHPUnit_Framework_TestCase
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
    
    public function testSetPasswordWithoutValidator()
    {
        $user = new User();
        $pwdPlain = 'ichL1ebekast3nbrot';
        $pwdHashed = sha1($pwdPlain);
        $user->setPassword($pwdPlain);
        self::assertSame($pwdHashed, $user->getPassword());
    }
    
    private function getValidatorMock($return)
    {
        $mock = $this->getMock('Validator\ValidatorInterface');
        $mock->expects($this->once())
             ->method('isValid')
             ->will($this->returnValue($return));
        return $mock;
    }
    
    /**
     * 
     * @expectedException InvalidArgumentException
     */
    public function testSetInvalidPasswordWithValidator()
    {
        $user = new User();
        $user->setPasswordValidator($this->getValidatorMock(false));
        $user->setPassword('istgradegalwelchespasswortichhiereingebe');
    }
    
    public function testSetValidPasswordWithValidator()
    {
        $user = new User();
        $user->setPasswordValidator($this->getValidatorMock(true));
        $user->setPassword('istgradegalwelchespasswortichhiereingebe');
    }
}