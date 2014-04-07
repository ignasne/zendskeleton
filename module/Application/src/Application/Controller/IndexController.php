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

use Application\Services;

require_once 'C:\www\zendskeleton\module\Application\src\Services\StringReverser.php';
require_once 'C:\www\zendskeleton\module\Application\src\Services\ActionLogger.php';

class IndexController extends AbstractActionController
{
	protected $service;

	public function init()
	{

	}

	public function setStringReverserService(Services\StringReverser $service)
	{
		$this->service = $service;
	}

    public function indexAction()
    {


	    print_r($this->service->reverseString("abc")); die();

        return new ViewModel();
    }

	public function soapAction()
	{
		$server = new Server(null,
			array('uri' => 'http://zendskeleton.localhost/application/index/wsdl'));

		$server->setClass('StringReverser');

		$server->handle();

		return $this->getResponse();
	}

	public function wsdlAction()
	{
		$wsdl = new AutoDiscover();

		$wsdl->setClass('StringReverser');

		$wsdl->setUri('http://zendskeleton.localhost/application/index/soap');

		$wsdl->handle();
		return $this->getResponse();
	}

	public function clientAction()
	{
		$url = 'http://zendskeleton.localhost/application/index/wsdl';

		$client = new Client($url);

		print_r($client->reverseString("abc"));

		return $this->getResponse();
	}
}
