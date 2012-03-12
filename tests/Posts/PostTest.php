<?php
namespace Posts;

/**
 * @author jketterl
 * @covers Posts\Post
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsText()
    {
        $message = 'Das ist ein Testpost.';
        $post = new Post();
        $post->setText($message);
        
        self::assertEquals($message, $post->getText());
    }
    
    public function testToStringWorks()
    {
        $message = 'a public announcment to all testers';
        $post = new Post();
        $post->setText($message);
        
        self::assertEquals($message, (string) $post);
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
        $post = new Post();
        $post->setTextValidator($this->getValidatorMock(false));
        $post->setText('istgradegalwelchentextichhiereingebe');
    }
    
    public function testSetValidPasswordWithValidator()
    {
        $post = new Post();
        $post->setTextValidator($this->getValidatorMock(true));
        $post->setText('istgradegalwelchentextichhiereingebe');
    }
}