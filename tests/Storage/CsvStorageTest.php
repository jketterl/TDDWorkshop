<?php
namespace Storage;

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
        $this->_csvFile = __DIR__ . '/../../posts.csv';
        $this->_storage = new CsvStorage('stdClass', $this->_csvFile, Array(0 => 'text'));
    }
     
    public function testRetrievesObject()
    {
        $post = $this->_storage->find(1);
        self::assertInstanceOf('stdClass', $post);
        self::assertRegExp('/Teilnehmer.*betreten/', $post->text);
    }
    
    public function testRetrievesAll()
    {
        $posts = $this->_storage->findAll();
        self::assertInternalType('array', $posts);
        foreach ($posts as $post) self::assertInstanceof('stdClass', $post);
    }
    
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage not supported
     */
    public function testThrowsExceptionOnStore()
    {
        $post = new \stdClass();
        $post->text = 'das ist ein neuer liveticker-eintrag';
        $this->_storage->store($post);
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage EOF reached
     */
    public function testThrowsExceptionOnEof()
    {
        // count the number of lines in our csv file
        $lines = count(file($this->_csvFile));
        // indices start counting at 0, so accessing the storage at the line count should trigger an exception.
        $this->_storage->find($lines);
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