<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\{RequestHandlerInterface, RequestHandlerTrait};
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\RequestHandlerTrait
 */
class RequestHandlerTraitTest extends TestCase {

	/**
	 * @covers ::getRequestHandler
	 *
	 * @return void
	 */
	public function testGetRequestHandler(): void {
		$Stub = $this->createStub(RequestHandlerInterface::class);
		$Sut = $this->getObjectForTrait(RequestHandlerTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getRequestHandler");
		$Property = $RC->getProperty("RequestHandler");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
