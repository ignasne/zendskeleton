<?php

/**
 * Interface StringReverserInterface
 * @package Application\Services
 */
interface StringReverserInterface
{
	/**
	 * @param ActionLoggerInterface $actionLogger
	 * @return mixed
	 */
	public function setActionLogger(\Application\Services\ActionLoggerInterface $actionLogger);

	/**
	 * @param $string
	 * @return mixed
	 */
	public function reverseString($string);
}