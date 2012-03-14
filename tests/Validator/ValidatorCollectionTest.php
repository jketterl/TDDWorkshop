<?php
namespace Validator;

class ValidatorCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $_collection;
    
    protected function setUp()
    {
        $this->_collection = new ValidatorCollection();
    }
    
    public function testInterfaceIsImplemented()
    {
        self::assertInstanceOf('Validator\ValidatorInterface', $this->_collection);
    }
}