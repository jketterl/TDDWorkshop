<?php
namespace Storage;

use Posts\User;

use org\bovigo\vfs\vfsStream;

/**
 * @author jketterl
 * 
 * @group storage
 * 
 * @covers Storage\CsvStorage
 */
class CsvStorageTest extends \PHPUnit_Framework_TestCase
{
    private $_vfsNamespace = 'CsvStorageTest';
    private $_csvFile;
    private $_storage;
    
    protected function setUp()
    {
        parent::setUp();
        vfsStream::setup($this->_vfsNamespace);
        $this->_csvFile = vfsStream::url($this->_vfsNamespace . '/test.csv');
        file_put_contents(
            $this->_csvFile,
            <<<EOF
atest;Alfons Testhuber
btest;Beatrix Testmeier
cbeispiel;Conrad Beispieluser
EOF
        );
        $this->_storage = new CsvStorage('Posts\User', $this->_csvFile, Array(0 => 'login', 1 => 'name'));
    }
     
    public function testRetrievesUser()
    {
        $user = $this->_storage->find(1);
        self::assertInstanceOf('Posts\User', $user);
        self::assertEquals('btest', $user->getLogin());
        self::assertEquals('Beatrix Testmeier', $user->getName());
    }
    
    public function testRetrievesAll()
    {
        $users = $this->_storage->findAll();
        foreach ($users as $user) self::assertInstanceof('Posts\User', $user);
    }
    
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage not supported
     */
    public function testThrowsExceptionOnStore()
    {
        $user = new User();
        $user->setLogin('bla')->setName('blubb');
        $this->_storage->store($user);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage EOF reached
     */
    public function testThrowsExceptionOnEof()
    {
        // our csv file only contains three lines, so accessing index 3 should translate do line #4
        $this->_storage->find(3);
    }
}