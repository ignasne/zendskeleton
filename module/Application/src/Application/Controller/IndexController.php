<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Soap\Client;
use Zend\Soap\Server;
use Zend\Soap\AutoDiscover;

require_once 'C:\www\zendskeleton\module\Application\src\Services\Services.php';

class IndexController extends AbstractActionController
{
	public function init()
	{

	}

    public function indexAction()
    {
	    $objectManager = $this
		    ->getServiceLocator()
		    ->get('Doctrine\ORM\EntityManager');

	    $soapActionLog = new \Application\Entity\SoapActionLog();
	    $soapActionLog->setResponse('1231238791732');
	    $soapActionLog->setRequest('1231238791732');
	    $soapActionLog->setDate();

	    $objectManager->persist($soapActionLog);
	    $objectManager->flush();

	    $soapActionLog->getId();

        return new ViewModel();
    }

	public function soapAction()
	{
		$server = new Server(null,
			array('uri' => 'http://zendskeleton.localhost/application/index/wsdl'));

		$server->setClass('Services');

		$server->handle();

		return $this->getResponse();
	}

	public function wsdlAction()
	{
		$wsdl = new AutoDiscover();

		$wsdl->setClass('Services');

		$wsdl->setUri('http://zendskeleton.localhost/application/index/soap');

		$wsdl->handle();
		return $this->getResponse();
	}

	public function clientAction()
	{
		$url = 'http://zendskeleton.localhost/application/index/wsdl';

		$client = new Client($url);

		print_r($client->testSoap());

		return $this->getResponse();
	}
}
