<?php

namespace Laz0r\HttpTest;

use Laminas\Diactoros\Response;
use Laz0r\Http\{
	AbstractOuterRequestHandler,
	RequestHandlerInterface,
	ResponseInterface,
};
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\AbstractOuterRequestHandler
 */
class AbstractOuterRequestHandlerTest extends TestCase {

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$Stub = $this->createStub(RequestHandlerInterface::class);
		$Property = (new ReflectionClass(AbstractOuterRequestHandler::class))
			->getProperty("Handler");
		$Sut = new class($Stub) extends AbstractOuterRequestHandler {

			public function handle(
				ServerRequestInterface $Request
			): ResponseInterface {
				return new Response();
			}

		};
		$Property->setAccessible(true);

		$this->assertSame($Stub, $Property->getValue($Sut));
	}

	/**
	 * @covers ::getInnerRequestHandler
	 *
	 * @return void
	 */
	public function testGetInnerRequestHandler(): void {
		$Stub = $this->createStub(RequestHandlerInterface::class);
		$Property = (new ReflectionClass(AbstractOuterRequestHandler::class))
			->getProperty("Handler");
		$Sut = new class() extends AbstractOuterRequestHandler {

			public function __construct() {
			}

			public function handle(
				ServerRequestInterface $Request
			): ResponseInterface {
				return new Response();
			}

		};

		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);

		$Result = $Sut->getInnerRequestHandler();

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
