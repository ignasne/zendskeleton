<?php
namespace Application\Services;

use Zend\Text\Exception\UnexpectedValueException;

interface StringReverserInterface
{
	public function reverseString($string);
}

class StringReverser implements StringReverserInterface
{
	/**
	 * Returns test list
	 *
	 * @param $string
	 * @return string
	 */
	public function reverseString($string)
	{
		$reversedString = "";

		if(empty($string))
		{
			throw new UnexpectedValueException("Empty string value. String value should be not empty!");
		}
		elseif(strlen($string) != 64)
		{
			throw new UnexpectedValueException("Given string should be exactly 64 characters length. String length is: " . strlen($string));
		}

		$reversedString = strrev($string);

		//$logger = new \Application\Services\ActionLogger();

		//$logger->logAction($string, $reversedString);

		return $reversedString;
	}
}