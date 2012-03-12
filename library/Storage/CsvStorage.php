<?php
namespace Storage;

class CsvStorage implements StorageInterface
{
    protected $_className;
    protected $_file;
    protected $_mapping;
    
    public function __construct($className, $file, $mapping = Array())
    {
        $this->_className = $className;
        if (!file_exists($file)) {
            throw new \InvalidArgumentException('csv file not found.');
        }
        $this->_file = $file;
        $this->_mapping = $mapping;
    }
    
    public function find($id)
    {
        $fp = fopen($this->_file, 'r');
        
        // in a csv file, the line number identifies the data object.
        // so eg. $id = 0 identifies the first line, $id = 1 the second and so on.
        for ($i = 0; $i <= $id; $i++) {
            // skip lines until you get to the one identified by $id;
            $line = fgetcsv($fp, 0, ';', '"');
            if ($line === FALSE) {
                throw new \InvalidArgumentException('EOF reached before requested id (' . $id . ') was found');
            }
        }
        
        // convert the last read line to an object & return it
        return $this->toObject($line);
    }
    
    public function findAll()
    {
        $fp = fopen($this->_file, 'r');
        $result = Array();
        $count = 0;
        
        while (($line = fgetcsv($fp, 0, ';', '"')) !== FALSE) {
            $object = $this->toObject($line);
            $object->id = $count++;
            $result[] = $object;
        }
        
        return $result;
    }
    
    public function store($object)
    {
        throw new \RuntimeException('storing into a csv file is not supported');
    }
    
    protected function toObject($data)
    {
        $object = new $this->_className();
        
        foreach ($this->_mapping as $offset => $target) {
            $object->$target = $data[$offset];
        }
        
        return $object;
    }
}