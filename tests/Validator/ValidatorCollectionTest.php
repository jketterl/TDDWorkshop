<?php
namespace Validator;

class ValidatorCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $_collection;
    
    protected function setUp()
    {
        $this->_collection = new ValidatorCollection();
    }
    
    protected function getMockedValidator($return)
    {
        $mock = $this->getMock('Validator\ValidatorInterface');
        $mock->expects($this->any())->method('isValid')->will($this->returnValue($return));
        return $mock;
    }
    
    public function testInterfaceIsImplemented()
    {
        self::assertInstanceOf('Validator\ValidatorInterface', $this->_collection);
    }
    
    public function testAddWorks()
    {
        $this->_collection->addValidator($this->getMockedValidator(true));
    }
    
    public function testReturnsTrueWhenAllValidatorsPass()
    {
        // don't use c&p ;)
        for ($i = 0; $i < 3; $i++)
            $this->_collection->addValidator($this->getMockedValidator(true));
        self::assertTrue($this->_collection->isValid('ambiguous'));
    }
    
    public function testPassesDataToValidators()
    {
        $data = 'some arbitrary string';
        $mock = $this->getMock('Validator\ValidatorInterface');
        $mock->expects($this->any())->method('isValid')->with($data);
        
        $this->_collection->addValidator($mock);
        $this->_collection->isValid($data);
    }
    
    public function testReturnsFalseWhenOneValidatorFails()
    {
        $this->_collection->addValidator($this->getMockedValidator(true));
        $this->_collection->addValidator($this->getMockedValidator(false));
        self::assertFalse($this->_collection->isValid('ambiguous'));
    }
}