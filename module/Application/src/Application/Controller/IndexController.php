<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Composer\Console\Application;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Soap\Client;
use Zend\Soap\Server;
use Zend\Soap\AutoDiscover;
use Zend\Di;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
	/**
	 * Zend skeleton application default action
	 *
	 * @return ViewModel
	 */
	public function indexAction()
    {
	    $sm = $this->getServiceLocator();
	    $stringReserver = $sm->get('Application\Service\StringReverser');

	    var_dump($stringReserver->reverseString("1234567891234567891234567791234567891234567891234567791248798745"));

        return new ViewModel();
    }

	/**
	 * Soap action
	 *
	 * @return \Zend\Stdlib\ResponseInterface
	 */
	public function soapAction()
	{
		$server = new Server(null,
			array('uri' => 'http://zendskeleton.localhost/application/index/wsdl'));

		$sm = $this->getServiceLocator();
		$stringReserver = $sm->get('Application\Service\StringReverser');

		$server->setObject($stringReserver);

		$server->handle();

		return $this->getResponse();
	}

	/**
	 * Soap service wsdl result
	 *
	 * @return \Zend\Stdlib\ResponseInterface
	 */
	public function wsdlAction()
	{
		$complexTypeStrategy = new \Zend\Soap\Wsdl\ComplexTypeStrategy\AnyType();
		$complexTypeStrategy->addComplexType("ActionLoggerInterface");

		$wsdl = new AutoDiscover();
		$wsdl->setComplexTypeStrategy($complexTypeStrategy);
		$wsdl->setClass('Application\Service\StringReverser');

		$wsdl->setUri('http://zendskeleton.localhost/application/index/soap');

		$wsdl->handle();
		return $this->getResponse();
	}

	/**
	 * Soap client for soap service test
	 *
	 * @return \Zend\Stdlib\ResponseInterface
	 */
	public function clientAction()
	{
		$url = 'http://zendskeleton.localhost/application/index/wsdl';

		$client = new Client($url);

		echo $client->reverseString("1234567891234567891234567791234567891234567891234567791248798745");

		return $this->getResponse();
	}
}
