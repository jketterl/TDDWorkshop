<?php
namespace Json;

class UtfEncoder
{
    public function encode($data)
    {
        switch (gettype($data)) {
            case 'integer':
                return $data;
            case 'string':
                return utf8_encode($data);
            case 'array':
                $result = Array();
                foreach ($data as $key => $value) {
                    $result[$this->encode($key)] = $this->encode($value);
                }
                return $result;
            default:
                throw new \RuntimeException('cannot encode variable type "' . gettype($data) . '"');
        }
    }
}