<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\ServerRequestFactoryTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestFactoryInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\ServerRequestFactoryTrait
 */
class ServerRequestFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getServerRequestFactory
	 *
	 * @return void
	 */
	public function testGetServerRequestFactory(): void {
		$Stub = $this->createStub(ServerRequestFactoryInterface::class);
		$Sut = $this->getObjectForTrait(ServerRequestFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getServerRequestFactory");
		$Property = $RC->getProperty("ServerRequestFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
