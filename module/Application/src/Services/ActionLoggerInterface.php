<?php

/**
 * Interface ActionLoggerInterface
 * @package Application\Services
 */
interface ActionLoggerInterface
{
	/**
	 * @param \Doctrine\ORM\EntityManagerInterface $orm
	 * @return mixed
	 */
	public function setOrm(\Doctrine\ORM\EntityManagerInterface $orm);

	/**
	 * @param $originalString
	 * @param $reversedString
	 * @return mixed
	 */
	public function logAction($originalString, $reversedString);
}