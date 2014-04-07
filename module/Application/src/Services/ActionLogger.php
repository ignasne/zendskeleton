<?php
namespace Application\Services;

use Application\Entity;

interface AcionLoggerInterface
{
	public function logAction($originalString, $reversedString);
}

class ActionLogger implements AcionLoggerInterface
{
	public function logAction($originalString, $reversedString)
	{
		$soapActionLog = new \Application\Entity\SoapActionLog();

		$soapActionLog->setRequest($originalString);
		$soapActionLog->setResponse($reversedString);

		//$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		//$this->_objectManager->persist($soapActionLog);
		//$this->_objectManager->flush();

		return true;
	}
}