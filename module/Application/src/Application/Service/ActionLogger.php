<?php
namespace Application\Service;


/**
 * Class ActionLogger
 * @package Application\Service
 */
class ActionLogger implements \Application\Service\ActionLoggerInterface
{
	/**
	 * Class responsible for action logging
	 *
	 * @var
	 */
	protected $logger;

	/**
	 * Sets logger object
	 *
	 * @param logger $logger
	 * @return mixed|void
	 */
	public function setLogger($logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Logs request data to StringReverser service
	 *
	 * @param $originalString
	 * @param $reversedString
	 * @return bool|mixed
	 * @throws Exception
	 */
	public function logAction($originalString, $reversedString)
	{
		$soapActionLog = new \Application\Entity\SoapActionLog();

		$soapActionLog->setRequest($originalString);
		$soapActionLog->setResponse($reversedString);

		if($this->logger === null || !method_exists($this->logger, "persist"))
		{
			throw new Exception("Set Logger object instance of ActionLogger class.");
		}

		$this->logger->persist($soapActionLog);
		$this->logger->flush();

		return true;
	}
}