<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\UploadedFileFactoryTrait;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UploadedFileFactoryInterface;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\UploadedFileFactoryTrait
 */
class UploadedFileFactoryTraitTest extends TestCase {

	/**
	 * @covers ::getUploadedFileFactory
	 *
	 * @return void
	 */
	public function testGetUploadedFileFactory(): void {
		$Stub = $this->createStub(UploadedFileFactoryInterface::class);
		$Sut = $this->getObjectForTrait(UploadedFileFactoryTrait::class);
		$RC = new ReflectionClass(get_class($Sut));
		$Method = $RC->getMethod("getUploadedFileFactory");
		$Property = $RC->getProperty("UploadedFileFactory");
		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
