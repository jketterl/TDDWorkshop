<?php
namespace Validator;

interface ValidatorInterface
{
    /**
     * Returns whether or not a given input is valid.
     * May also throw a ValidatorException to pass a more detailed message about what went wrong.
     * 
     * @param mixed $data input to be validated
     * @throws ValidatorException
     */
    public function isValid($data);
}