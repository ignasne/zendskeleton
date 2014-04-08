<?php

/**
 * Zendskeleton application Tests
 *
 * Class StringReverserTests
 */

require_once 'C:\www\zendskeleton\module\Application\src\Services\StringReverser.php';
require_once 'C:\www\zendskeleton\module\Application\src\Services\ActionLogger.php';
require_once 'C:\www\zendskeleton\module\Application\src\Application\Entity\SoapActionLog.php';

class StringReverserTests extends PHPUnit_Framework_TestCase
{
	// Doctrine 2 entity manager
	protected $em;
	protected $doctrine;

	public function setUp()
	{
		$this->em = $this->getMock('EntityManager', array('persist', 'flush'));

		$this->em->expects($this->any())
			->method('persist')
			->will($this->returnValue(true));

		$this->em->expects($this->any())
			->method('flush')
			->will($this->returnValue(true));

		$this->doctrine = $this->getMock('Doctrine', array('getEntityManager'));

		$this->doctrine
			->expects($this->any())
			->method('getEntityManager')
			->will($this->returnValue($this->em));
	}

	public function tearDown()
	{
		$this->doctrine = null;
		$this->em = null;
	}


	public function testStringReverserReturnExceptionOnEmptyStringRequest()
	{
		$this->setExpectedException(
			'UnexpectedValueException', 'Empty string value. String value should be not empty!'
		);

		$stringReverser = new Application\Services\StringReverser();

		$stringReverser->reverseString("");
	}

	public function testStringReverserReturnExceptionOnStringNot64Length()
	{
		$this->setExpectedException(
			'UnexpectedValueException', 'Given string should be exactly 64 characters length. String length is: 3'
		);

		$stringReverser = new Application\Services\StringReverser();

		$stringReverser->reverseString("abc");
	}

	public function testStringReverserShouldReverseString()
	{
		$stringToReverse = "1234567891234567891234567791234567891234567891234567791248798745";
		$staticResultFromStringReverser = "5478978421977654321987654321987654321977654321987654321987654321";

		$stringReverser = new Application\Services\StringReverser();

		$resultFromStringReverser = $stringReverser->reverseString($stringToReverse);

		$this->assertEquals($resultFromStringReverser, $staticResultFromStringReverser);
	}

	public function testSaveActionLoggerEntityWithEntityManagerMockReturnsTrue()
	{
		$soapActionLog = new \Application\Entity\SoapActionLog();

		$soapActionLog->setRequest("1234567891234567891234567791234567891234567891234567791248798745");
		$soapActionLog->setResponse("5478978421977654321987654321987654321977654321987654321987654321");

		$this->assertEquals($this->em->persist($soapActionLog), true);
		$this->assertEquals($this->em->flush(), true);
	}

	public function testActionLoggerEntityWithBadRequestStringReturnsException()
	{
		$this->setExpectedException(
			'Exception', '"Given string should be exactly 64 characters length. String length is: 3'
		);

		$soapActionLog = new \Application\Entity\SoapActionLog();

		$soapActionLog->setRequest("123");
	}
}