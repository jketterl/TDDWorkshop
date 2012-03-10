<?php
namespace Config;

use org\bovigo\vfs\vfsStream;

class WebTest extends \PHPUnit_Framework_TestCase
{
    private $_vfsNamespace = 'ConfigWebTest';
    private $_configFile;
    
    public function setUp()
    {
        parent::setUp();
        vfsStream::setup($this->_vfsNamespace);
        $this->_configFile = vfsStream::url($this->_vfsNamespace . '/config.ini');
        file_put_contents(
            $this->_configFile,
            <<<EOT
[database]
host = localhost
user = root
EOT
        );
    }
    
    public function testGetWithSection()
    {
        $config = new Web($this->_configFile);
        $dbConfig = array(
            'host' => 'localhost',
            'user' => 'root'
        );
        $this->assertSame($dbConfig, $config->get('database'));
    }
    
    public function testGetInvalidSections()
    {
        $config = new Web($this->_configFile);
        $this->assertNull($config->get('horst'));
    }
    
    public function testGetWithoutSection()
    {
        $config = new Web($this->_configFile);
        $configArray = array(
            'database' => array(
            	'host' => 'localhost',
            	'user' => 'root'
        	)
        );
        $this->assertSame($configArray, $config->get());
    }
}