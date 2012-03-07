<?php
namespace Validator;

class Profanity implements ValidatorInterface
{
	/**
	 * Diese Woerter sind nicht erwuenscht
	 * 
	 * @var Array
	 */
	private $_forbiddenWords = array(
		'fuck',
		'shit',
		'Mario Barth'
	);
	
	/**
	 * Pruefen, ob verbotene Woerter im uebergebenen Text vorkommen
	 * 
	 * @see Validator.ValidatorInterface::isValid()
	 */
	public function isValid($data)
	{
		foreach ($this->_forbiddenWords as $word) {
			if (strstr($data, $word)) {
				return false;
			} 
		}
		
		return true;
	}
}