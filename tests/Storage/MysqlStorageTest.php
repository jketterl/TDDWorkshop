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
    
    public function testRetrievesList()
    {
        $storage = new MysqlStorage('user', 'Posts\Post');
        $list = $storage->getAll();
        
        self::assertInternalType('array', $list);
        self::assertInstanceOf('Posts\Post', $list[0]);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage does not exist
     */
    public function testThrowsExceptionOnInvalidClassName()
    {
        $storage = new MysqlStorage('user', 'Dummy\Pseudo');
    }
}