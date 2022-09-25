<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\{
	Dispatcher,
	RequestHandlerInterface,
	ResponseInterface,
};
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\Dispatcher
 */
class DispatcherTest extends TestCase {

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$StubA = $this->createStub(RequestHandlerInterface::class);
		$StubB = $this->createStub(ServerRequestInterface::class);
		$RC = new ReflectionClass(Dispatcher::class);
		$PropertyA = $RC->getProperty("RequestHandler");
		$PropertyB = $RC->getProperty("ServerRequest");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Sut->__construct($StubA, $StubB);

		$PropertyA->setAccessible(true);
		$PropertyB->setAccessible(true);

		$this->assertSame($StubA, $PropertyA->getValue($Sut));
		$this->assertSame($StubB, $PropertyB->getValue($Sut));
	}

	/**
	 * @covers ::dispatch
	 *
	 * @return void
	 */
	public function testDispatch(): void {
		$Request = $this->createStub(ServerRequestInterface::class);
		$Response = $this->createStub(ResponseInterface::class);
		$Mock = $this->createStub(RequestHandlerInterface::class);
		$Sut = $this->getMockBuilder(Dispatcher::class)
			->disableOriginalConstructor()
			->onlyMethods(["getRequestHandler", "getServerRequest"])
			->getMock();

		$Mock->expects($this->once())
			->method("handle")
			->with($this->identicalTo($Request))
			->will($this->returnValue($Response));
		$Sut->expects($this->once())
			->method("getServerRequest")
			->will($this->returnValue($Request));
		$Sut->expects($this->once())
			->method("getRequestHandler")
			->will($this->returnValue($Mock));

		$Result = $Sut->dispatch();

		$this->assertSame($Response, $Result);
	}

	/**
	 * @covers ::getRequestHandler
	 *
	 * @return void
	 */
	public function testGetRequestHandler(): void {
		$Stub = $this->createStub(RequestHandlerInterface::class);
		$RC = new ReflectionClass(Dispatcher::class);
		$Method = $RC->getMethod("getRequestHandler");
		$Property = $RC->getProperty("RequestHandler");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::getServerRequest
	 *
	 * @return void
	 */
	public function testGetServerRequest(): void {
		$Stub = $this->createStub(ServerRequestInterface::class);
		$RC = new ReflectionClass(Dispatcher::class);
		$Method = $RC->getMethod("getServerRequest");
		$Property = $RC->getProperty("ServerRequest");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
