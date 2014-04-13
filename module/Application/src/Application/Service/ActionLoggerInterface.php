<?php

namespace Application\Service;

/**
 * Interface ActionLoggerInterface
 * @package Application\Service
 */
interface ActionLoggerInterface
{
	/**
	 * Setting logger for action logging
	 *
	 * @param $logger logger object
	 * @return mixed
	 */
	public function setLogger($logger);

	/**
	 * @param $originalString
	 * @param $reversedString
	 * @return mixed
	 */
	public function logAction($originalString, $reversedString);
}