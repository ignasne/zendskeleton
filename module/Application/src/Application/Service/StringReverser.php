<?php
namespace Application\Service;

use Symfony\Component\Console\Application;
use Zend\Text\Exception\UnexpectedValueException;


/**
 * Class StringReverser
 * @package Application\Service
 */
class StringReverser implements \Application\Service\StringReverserInterface
{
	/**
	 * Logging action object
	 *
	 * @var \Application\Service\ActionLoggerInterface
	 */
	protected $actionLogger;

	/**
	 * Sets action logger instance
	 *
	 * @param \Application\Service\ActionLoggerInterface $actionLogger
	 * @return mixed|void
	 */
	public function setActionLogger(\Application\Service\ActionLoggerInterface $actionLogger)
	{
		$this->actionLogger = $actionLogger;
	}

	/**
	 * Returns reversed string
	 *
	 * @param $string
	 * @return mixed|string
	 * @throws \Zend\Text\Exception\UnexpectedValueException
	 */
	public function reverseString($string)
	{
		// initialize of variable for understanding variable type
		$reversedString = "";

		if(empty($string))
		{
			throw new UnexpectedValueException("Empty string value. String value should be not empty!");
		}
		elseif(strlen($string) != 64)
		{
			throw new UnexpectedValueException("Given string should be exactly 64 characters length. String length is: " . strlen($string));
		}

		try
		{
			$reversedString = strrev($string);
		}
		catch(Exception $e)
		{
			echo 'Error reversing string: ' .  $e->getMessage();
		}

		if($this->actionLogger != null)
		{
			try
			{
				$this->actionLogger->logAction($string, $reversedString);
			}
			catch(Exception $e)
			{
				echo 'Action logger exception: ' .  $e->getMessage();
			}
		}

		return $reversedString;
	}
}