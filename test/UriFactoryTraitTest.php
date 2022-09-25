<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\UriFactoryTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriFactoryInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\UriFactoryTrait
 */
class UriFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getUriFactory
	 *
	 * @return void
	 */
	public function testGetUriFactory(): void {
		$Stub = $this->createStub(UriFactoryInterface::class);
		$Sut = $this->getObjectForTrait(UriFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getUriFactory");
		$Property = $RC->getProperty("UriFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
