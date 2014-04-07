<?php
namespace Application\Services;

use Application\Entity;

class ActionLogger
{
	protected $_objectManager;

	public function __construct()
	{
		$this->getObjectManager();
	}

	public function logAction($originalString, $reversedString)
	{
		$soapActionLog = new \Application\Entity\SoapActionLog();

		$soapActionLog->setRequest($originalString);
		$soapActionLog->setResponse($reversedString);

		$this->_objectManager->persist($soapActionLog);
		$this->_objectManager->flush();

		return true;
	}

	protected function getObjectManager()
	{
		if (!$this->_objectManager) {
			$this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}

		return $this->_objectManager;
	}
}