<?php

namespace Application\Service;

/**
 * Interface StringReverserInterface
 * @package Application\Service
 */
interface StringReverserInterface
{
	/**
	 * @param ActionLoggerInterface $actionLogger
	 * @return mixed
	 */
	public function setActionLogger(\Application\Service\ActionLoggerInterface $actionLogger);

	/**
	 * @param $string
	 * @return mixed
	 */
	public function reverseString($string);
}