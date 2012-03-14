<?php
namespace Validator;

class ValidatorCollection implements ValidatorInterface
{
    private $_validators = Array();
    
    public function isValid($data)
    {
        foreach ($this->_validators as $validator) {
            if (!$validator->isValid($data)) return false;
        }
        return true;
    }
    
    public function addValidator(ValidatorInterface $validator)
    {
        $this->_validators[] = $validator;
    }
}