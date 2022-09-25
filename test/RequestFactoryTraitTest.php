<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\RequestFactoryTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\RequestFactoryTrait
 */
class RequestFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getRequestFactory
	 *
	 * @return void
	 */
	public function testGetRequestFactory(): void {
		$Stub = $this->createStub(RequestFactoryInterface::class);
		$Sut = $this->getObjectForTrait(RequestFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getRequestFactory");
		$Property = $RC->getProperty("RequestFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
