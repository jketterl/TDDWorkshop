<?php
namespace Storage;

/**
 * @author jketterl
 * 
 * @group rest
 * @group storage
 * 
 * @covers Storage\RestStorage
 */
class RestStorageTest extends \PHPUnit_Framework_TestCase
{
    protected $_client;
    protected $_storage;
    
    private function getFormatMock()
    {
        $mock = $this->getMock('Format\FormatInterface');
        $mock->expects($this->once())
             ->method('getFileExtension')
             ->will($this->returnValue('json'));
             
        $mock->expects($this->any())
             ->method('decode')
             ->will($this->returnCallback(function($in) {
                 return json_decode($in);
             }));
        return $mock;
    }
    
    protected function setUp()
    {
        $this->_client = $this->getMock('Http\HttpClientInterface');
        $format = $this->getFormatMock();
        $this->_storage = new RestStorage('http://localhost/rest/user', 'stdClass', $format);
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
        
        $users = $this->_storage->findAll();
        self::assertEquals(2, count($users));
        foreach ($users as $user) self::assertInstanceOf('stdClass', $user);
    }
    
    public function testRetrievesObject()
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
        
        $user = $this->_storage->find(42);
        self::assertInstanceOf('stdClass', $user);
        self::assertEquals('atest', $user->login);
        self::assertEquals('Alfred Testbenutzer', $user->name);
    }
    
    public function testPostsNewObject()
    {
        $user = new \stdClass();
        $user->login = 'atest';
        $user->name = 'Alfons Testhuber';
        
        $this->_client->expects($this->at(0))
                      ->method('post')
                      ->with(
                          'http://localhost/rest/user.json',
                          Array('login' => 'atest', 'name' => 'Alfons Testhuber')
                      );
        
        $this->_storage->store($user);
    }
    
    public function testPutsExistingObject()
    {
        $user = new \stdClass();
        $user->login = 'atest';
        $user->name = 'Alfons Testhuber';
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