<?php
namespace Storage;

class MysqlStorageTest extends \PHPUnit_Framework_TestCase
{
    public function testRetrievesUser()
    {
        $storage = new MysqlStorage('user', 'Posts\Post');
        $user = $storage->load(1);
        self::assertInstanceOf('Posts\Post', $user);
    }
}