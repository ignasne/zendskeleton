<?php
namespace Application\Services;


/**
 * Class ActionLogger
 * @package Application\Services
 */
class ActionLogger implements \Application\Services\ActionLoggerInterface
{
	/**
	 * Doctrine ORM object
	 *
	 * @var
	 */
	protected $orm;

	/**
	 * Sets Doctrine orm object
	 *
	 * @param \Doctrine\ORM\EntityManagerInterface $orm
	 * @return mixed|void
	 */
	public function setOrm(\Doctrine\ORM\EntityManagerInterface $orm)
	{
		$this->orm = $orm;
	}

	/**
	 * Logs request data to StringReverser service
	 *
	 * @param $originalString
	 * @param $reversedString
	 * @return bool|mixed
	 */
	public function logAction($originalString, $reversedString)
	{
		$soapActionLog = new \Application\Entity\SoapActionLog();

		$soapActionLog->setRequest($originalString);
		$soapActionLog->setResponse($reversedString);

		if(!($this->orm instanceOf \Doctrine\ORM\EntityManagerInterface))
		{
			throw new Exception("Set ORM object instance of ActionLogger class.");
		}

		$this->orm->persist($soapActionLog);
		$this->orm->flush();

		return true;
	}
}