<?php
namespace Posts;

class PostList implements \Iterator
{
    protected $_file;
    
    protected $_current;
    
    protected $_index;
    
    public function __construct($postsFile)
    {
        if (!file_exists($postsFile)) {
            throw new \InvalidArgumentException('posts file not found.');
        }
        $this->_file = fopen($postsFile, 'r');
    }
    
    protected function read()
    {
        $line = fgetcsv($this->_file, 0, ';', '"');
        if ($line === FALSE) return false;
        $post = new Post();
        $post->setText($line[0]);
        if (isset($this->_index)) {
            $this->_index++;
        } else {
            $this->_index = 0;
        }
        return $post;
    }
    
    public function current()
    {
        return $this->_current;
    }

    public function next()
    {
        $this->_current = $this->read();
    }

    public function key()
    {
        return $this->_index;
    }

    public function valid()
    {
        return $this->_current !== FALSE;
    }
    
    public function rewind()
    {
        unset($this->_index);
        $this->_current = $this->read();
    }
}