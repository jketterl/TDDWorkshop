<?php
namespace Admin;

class UserListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * User List erstellen
     * 
     * @return UserList
     */
    public function getUserList()
    {
        $usersFile = __DIR__ . '/../../users.csv';
        $list = new UserList($usersFile);
        return $list;
    }
    
    public function testCreationSucceeds()
    {
        $list = $this->getUserList();
        self::assertInstanceOf('Admin\UserList', $list);
    }
    
    /**
     * 
     * @expectedException InvalidArgumentException
     */
    public function testCreationFails()
    {
        $list = new UserList('foobar.txt');
    }
    
    public function testGetAll()
    {
        $list = $this->getUserList();
        $users = $list->getAll();
        self::assertInternalType('array', $users);
        self::assertEquals(2, count($users));
        self::assertInstanceOf('Admin\User', $users[0]);
    }
}