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
                    $result[$key] = $this->encode($value);
                }
                return $result;
            case 'object':
                $result = new \stdClass();
                foreach ($data as $key => $value) {
                    $result->$key = $this->encode($value);
                }
                return $result;
            default:
                throw new \InvalidArgumentException('cannot encode variable type "' . gettype($data) . '"');
        }
    }
}