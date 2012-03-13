<?php
namespace Posts;

/**
 * @author jketterl
 * @covers Posts\Post
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    protected function getMockedValidator($return)
    {
        $mock = $this->getMock('Validator\ValidatorInterface');
        $mock->expects($this->any())->method('isValid')->will($this->returnValue($return));
        return $mock;
    }
    
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
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Keine Schimpfworte
     */
    public function testThrowsExceptionWhenValidationFails()
    {
        $message = 'das ist eine testmessage';
        $post = new Post();
        // get a validator that will always return false
        $validator = $this->getMockedValidator(false);
        $post->setValidator($validator);
        $post->setText($message);
    }
    
    public function testTextIsSetWhenValidationPasses()
    {
        $message = 'das ist eine testmessage';
        $post = new Post();
        // get a validator that will always return true
        $validator = $this->getMockedValidator(true);
        $post->setValidator($validator);
        $post->setText($message);
        
        self::assertEquals($post->getText(), $message);
    }
    
    public function testStoreCallsStorage()
    {
        $post = new Post();
        $post->setText('das ist ein probetext');
        $mock = $this->getMock('Storage\StorageInterface');
        $mock->expects($this->once())->method('store')->with($post);
        $post->setStorage($mock);
        $post->store();
    }
}