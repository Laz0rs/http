<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\StreamFactoryTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamFactoryInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\StreamFactoryTrait
 */
class StreamFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getStreamFactory
	 *
	 * @return void
	 */
	public function testGetStreamFactory(): void {
		$Stub = $this->createStub(StreamFactoryInterface::class);
		$Sut = $this->getObjectForTrait(StreamFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getStreamFactory");
		$Property = $RC->getProperty("StreamFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
