<?php
namespace Posts;

class Post
{
    public $text;

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function __toString()
    {
        return $this->getText();
    }
}
