<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\{ResponseFactoryInterface, ResponseFactoryTrait};
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\ResponseFactoryTrait
 */
class ResponseFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getResponseFactory
	 *
	 * @return void
	 */
	public function testGetResponseFactory(): void {
		$Stub = $this->createStub(ResponseFactoryInterface::class);
		$Sut = $this->getObjectForTrait(ResponseFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getResponseFactory");
		$Property = $RC->getProperty("ResponseFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
