<?php
namespace Storage;

/**
 * @author jketterl
 * @group rest
 */
use Posts\User;

class RestStorageTest extends \PHPUnit_Framework_TestCase
{
    protected $_client;
    protected $_storage;
    
    protected function setUp()
    {
        $this->_client = $this->getMock('Http\HttpClientInterface');
        $this->_storage = new RestStorage('http://localhost/rest/user', 'Posts\User');
        $this->_storage->setClient($this->_client);
    }
    
    public function testRetrievesList()
    {
        $json = json_encode(
            Array(
                Array(
                    'id' => 1,
                    'login' => 'atest',
                    'name' => 'Alfred Testbenutzer'
                ),
                Array(
                    'id' => 2,
                    'login' => 'bbeispiel',
                    'name' => 'Bernadette Beispiel'
                )
            )
        );
        $this->_client->expects($this->at(0))
                      ->method('get')
                      ->with('http://localhost/rest/user.json')
                      ->will($this->returnValue($json));
        
        $users = $this->_storage->getAll();
        self::assertEquals(2, count($users));
        foreach ($users as $user) self::assertInstanceOf('Posts\User', $user);
    }
    
    public function testRetrievesUser()
    {
        $json = json_encode(
            Array(
                'id' => 1,
                'login' => 'atest',
                'name' => 'Alfred Testbenutzer'
            )
        );
        
        $this->_client->expects($this->at(0))
                      ->method('get')
                      ->with('http://localhost/rest/user/42.json')
                      ->will($this->returnValue($json));
        
        $user = $this->_storage->load(42);
        self::assertInstanceOf('Posts\User', $user);
        self::assertEquals('atest', $user->getLogin());
        self::assertEquals('Alfred Testbenutzer', $user->getName());
    }
    
    public function testPostsNewUser()
    {
        $user = new User();
        $user->setLogin('atest')->setName('Alfons Testhuber');
        
        $this->_client->expects($this->at(0))
                      ->method('post')
                      ->with(
                          'http://localhost/rest/user.json',
                          Array('login' => 'atest', 'name' => 'Alfons Testhuber')
                      );
        
        $this->_storage->store($user);
    }
    
    public function testPutsExistingUser()
    {
        $user = new User();
        $user->setLogin('atest')->setName('Alfons Testhuber');
        $user->id = 42;
        
        $this->_client->expects($this->at(0))
                      ->method('put')
                      ->with(
                          'http://localhost/rest/user/42.json',
                          Array('login' => 'atest', 'name' => 'Alfons Testhuber')
                      );
        
        $this->_storage->store($user);
    }
}