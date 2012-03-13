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
}