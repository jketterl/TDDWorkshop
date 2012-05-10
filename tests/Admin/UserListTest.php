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
        self::assertGreaterThanOrEqual(2, count($users));
        self::assertInstanceOf('Admin\User', $users[0]);
    }
    
    public function testGetById()
    {
        $list = $this->getUserList();
        $userData = array(
            1,
            'Backup User',
            '4be30d9814c6d4e9800e0d2ea9ec9fb00efa887b'
        );
        $user = new User;
        $user->load($userData);
        self::assertEquals($user, $list->getById(1));
    }
    
    /**
     * @expectedException OutOfBoundsException
     * @expectedExceptionMessage User doesn't exist
     */
    public function testGetByIdFails()
    {
        $list = $this->getUserList();
        $list->getById(42);
    }
}
