<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class SoapActionLog {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/** @ORM\Column(type="string") */
	protected $request;

	/** @ORM\Column(type="string") */
	protected $response;

	/** @ORM\Column(type="integer") */
	protected $date;

	public function __construct() {
		$this->date = time();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getRequest()
	{
		return $this->request;
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function setResponse($value)
	{
		$this->response = $value;
	}

	public function setRequest($value)
	{
		return $this->request = $value;
	}

	public function getDate(){
		return $this->date;
	}
}