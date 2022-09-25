<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\{DispatcherFactoryInterface, DispatcherFactoryTrait};
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\DispatcherFactoryTrait
 */
class DispatcherFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getDispatcherFactory
	 *
	 * @return void
	 */
	public function testGetDispatcherFactory(): void {
		$Stub = $this->createStub(DispatcherFactoryInterface::class);
		$Sut = $this->getObjectForTrait(DispatcherFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getDispatcherFactory");
		$Property = $RC->getProperty("DispatcherFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
