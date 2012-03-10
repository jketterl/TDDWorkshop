<?php
namespace Storage;

use Http\HttpClientInterface;

class RestStorage implements StorageInterface
{
    protected $_client;
    protected $_baseUrl;
    protected $_className;
    protected $_format;
    
    public function __construct($baseUrl, $className, $format = 'json')
    {
        $this->_baseUrl = $baseUrl;
        $this->_className = $className;
        $this->_format = $format;
    }
    
    public function setClient(HttpClientInterface $client)
    {
        $this->_client = $client;
        return $this;
    }
    
    public function getClient()
    {
        return $this->_client;
    }

    public function load($id)
    {
        $data = $this->decode($this->getClient()->get($this->_baseUrl . '/' . $id . '.' . $this->_format));
        return $this->toObject($data);
    }
    
    public function store($object)
    {
        $data = Array();
        foreach ($object as $key => $value) {
            if ($key == 'id') continue;
            $data[$key] = $value;
        }
        
        if (isset($object->id)) {
            $this->getClient()->put($this->_baseUrl . '/' . $object->id . '.' . $this->_format, $data);
        } else {
            $this->getClient()->post($this->_baseUrl . '.' . $this->_format, $data);
        }
    }
    
    public function getAll()
    {
        $response = $this->decode($this->getClient()->get($this->_baseUrl . '.' . $this->_format));
        $result = Array();
        foreach ($response as $data) {
            $result[] = $this->toObject($data);
        }
        return $result;
    }
    
    protected function decode($in)
    {
        // json_decode should not be hardcoded here, it should somehow be exchangeble (see the $format argument in the
        // constructor) but it will work fine for demonstration purposes
        return json_decode($in);
    }
    
    protected function toObject($data)
    {
        $object = new $this->_className;
        
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }
        
        return $object;
    }
}