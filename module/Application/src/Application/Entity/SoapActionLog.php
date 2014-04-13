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
	private $id;

	/** @ORM\Column(type="string") */
	private $request;

	/** @ORM\Column(type="string") */
	private $response;

	/** @ORM\Column(type="integer") */
	private $date;

	/**
	 * Sets log item creation date
	 */
	public function __construct() {
		$this->date = time();
	}

	/**
	 * Returns entity Id
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns server requested value
	 *
	 * @return string
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * Returns service result value (reversed string)
	 *
	 * @return mixed
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * Response value setter
	 *
	 * @param $value
	 */
	public function setResponse($value)
	{
		$this->validateString($value);

		$this->response = $value;
	}

	/**
	 * Request value setter
	 *
	 * @param $value
	 * @return mixed
	 */
	public function setRequest($value)
	{
		$this->validateString($value);

		return $this->request = $value;
	}

	/**
	 * Validates request and response value
	 *
	 * @param $value
	 * @return bool
	 * @throws Exception
	 */
	private function validateString($value)
	{
		if(strlen($value) != 64)
		{
			throw new Exception("Response and Request string value could should be exactly 64 characters length.");
		}

		return true;
	}

	/**
	 * Gets log time
	 *
	 * @return int
	 */
	public function getDate(){
		return $this->date;
	}
}