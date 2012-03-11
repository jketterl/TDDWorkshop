<?php
namespace Posts;

use org\bovigo\vfs\vfsStreamFile;

use org\bovigo\vfs\vfsStream;

/**
 * 
 * @author djungowski
 * 
 * @covers Posts\PostList
 */
class PostListTest extends \PHPUnit_Framework_TestCase
{
    private $_vfsNamespace = 'PostListTest';
    private $_postsFile;
    
    private $_posts = array(
        'Wir melden uns heute live von der CeBIT.',
		'Die Teilnehmer der Veranstaltung betreten erstmal den roten Teppich.',
		'Auch bekannte Gesichter wie Mathias Plica konnten gesichtet werden!',
		'Wir erwarten gespannt die Er�ffnung des B�ffets :)'
    );
    
    protected function setUp()
    {
        parent::setUp();
        $this->_postsFile = vfsStream::url($this->_vfsNamespace . '/posts.csv');
        vfsStream::setup($this->_vfsNamespace);
        file_put_contents(
            $this->_postsFile,
            implode(PHP_EOL, $this->_posts)
        );
    }
    
    /**
     * Gibt man PostList eine nicht vorhandene Datei, kommt eine Exception
     * 
     * @expectedException InvalidArgumentException
     */
    public function testCreationFail()
    {
        new PostList('lukasderlokomotivfuehrer.csv');
    }
    
    public function testRead()
    {
        $list = new PostList($this->_postsFile);
        foreach ($list as $post) {
            $this->assertInstanceOf('Posts\Post', $post);
            // Ueberpruefen, dass der richtige Text verwendet wurde
        }
    }
}