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
0;Wir melden uns heute live von der CeBIT.
1;Die Teilnehmer der Veranstaltung betreten erstmal den roten Teppich.
0;Auch bekannte Gesichter wie Mathias Plica konnten gesichtet werden!
2;Wir erwarten gespannt die Eröffnung des Büffets :)
EOF
        );
        $this->_storage = new CsvStorage('stdClass', $this->_csvFile, Array(0 => 'userid', 1 => 'text'));
    }
     
    public function testRetrievesObject()
    {
        $post = $this->_storage->find(1);
        self::assertInstanceOf('stdClass', $post);
        self::assertRegExp('/Teilnehmer.*betreten/', $post->text);
        self::assertEquals('1', $post->userid);
    }
    
    public function testRetrievesAll()
    {
        $posts = $this->_storage->findAll();
        self::assertInternalType('array', $posts);
        foreach ($posts as $post) self::assertInstanceof('stdClass', $post);
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
    
    public function testStoresObject()
    {
        $file = tempnam('/tmp', 'csvtest-');
        $storage = new CsvStorage('stdClass', $file, Array(0 => 'id', 1 => 'text'));
        
        $object = new \stdClass();
        $object->id = 42;
        $object->text = 'goodbye and thanks for all the fish';
        
        $storage->store($object);
        
        $fp = fopen($file, 'r');
        $line = fgetcsv($fp, 0, ';', '"');
        self::assertEquals(Array(42, 'goodbye and thanks for all the fish'), $line);
        fclose($fp);
        
        // clean up
        unlink($file);
    }
}