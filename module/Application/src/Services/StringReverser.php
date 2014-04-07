<?php
namespace Application\Services;


class StringReverser
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

		$reversedString = strrev($string);

		//$logger = new \Application\Services\ActionLogger();

		//$logger->logAction($string, $reversedString);

		return $reversedString;
	}
}