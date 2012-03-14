<?php
namespace Storage;

use Http\HttpClientInterface;

class RestStorage implements StorageInterface
{
    protected $_client;
    protected $_baseUrl;
    protected $_className;
    
    /**
     * Objekt, das das FormatInterface sowie das CodecInterface verwendet
     * 
     * @var Format\FormatInterface
     */
    protected $_format;
    
    public function __construct($baseUrl, $className, \Format\FormatInterface $format)
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

    public function find($id)
    {
        $data = $this->decode($this->getClient()->get($this->_baseUrl . '/' . $id . '.' . $this->_format->getFileExtension()));
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
            $this->getClient()->put($this->_baseUrl . '/' . $object->id . '.' . $this->_format->getFileExtension(), $data);
        } else {
            $this->getClient()->post($this->_baseUrl . '.' . $this->_format->getFileExtension(), $data);
        }
    }
    
    public function findAll()
    {
        $response = $this->decode($this->getClient()->get($this->_baseUrl . '.' . $this->_format->getFileExtension()));
        $result = Array();
        foreach ($response as $data) {
            $result[] = $this->toObject($data);
        }
        return $result;
    }
    
    protected function decode($in)
    {
        return $this->_format->decode($in);
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