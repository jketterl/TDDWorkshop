<?php
namespace Storage;

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
        $this->_storage = new CsvStorage('stdClass', $this->_csvFile, Array(0 => 'login', 1 => 'name'));
    }
     
    public function testRetrievesObject()
    {
        $user = $this->_storage->find(1);
        self::assertInstanceOf('stdClass', $user);
        self::assertEquals('btest', $user->login);
        self::assertEquals('Beatrix Testmeier', $user->name);
    }
    
    public function testRetrievesAll()
    {
        $users = $this->_storage->findAll();
        self::assertInternalType('array', $users);
        foreach ($users as $user) self::assertInstanceof('stdClass', $user);
    }
    
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage not supported
     */
    public function testThrowsExceptionOnStore()
    {
        $user = new \stdClass();
        $user->login = 'bla';
        $user->name = 'blubb';
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
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage file not found
     */
    public function testThrowsExceptionOnMissingFile()
    {
        $storage = new CsvStorage('stdClass', 'dummyfile.xxx');
    }
}