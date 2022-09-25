<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\Response;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\Http\Response
 */
class ResponseTest extends TestCase {

	/**
	 * @covers ::getAttributes
	 *
	 * @return void
	 */
	public function testGetAttributes(): void {
		$attr = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];
		$RC = new ReflectionClass(Response::class);
		$Property = $RC->getProperty("attributes");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $attr);

		$result = $Sut->getAttributes();

		$this->assertSame($attr, $result);
	}

	/**
	 * @covers ::getAttribute
	 *
	 * @return void
	 */
	public function testGetAttributeReturnsAttribute(): void {
		$attr = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];
		$RC = new ReflectionClass(Response::class);
		$Property = $RC->getProperty("attributes");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $attr);

		$Result = $Sut->getAttribute("Durrrr");

		$this->assertSame($attr["Durrrr"], $Result);
	}

	/**
	 * @covers ::getAttribute
	 *
	 * @return void
	 */
	public function testGetAttributeReturnsDefault(): void {
		$attr = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];
		$Stub = (object)[];
		$RC = new ReflectionClass(Response::class);
		$Property = $RC->getProperty("attributes");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $attr);

		$Result = $Sut->getAttribute("LOL", $Stub);

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::withAttribute
	 *
	 * @return void
	 */
	public function testWithAttributeReturnsClone(): void {
		$attr = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];
		$RC = new ReflectionClass(Response::class);
		$Property = $RC->getProperty("attributes");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $attr);

		$Result = $Sut->withAttribute("Herp", "Derp");

		$this->assertInstanceOf(Response::class, $Result);
		$this->assertNotSame($Sut, $Result);
	}

	/**
	 * @covers ::withAttribute
	 *
	 * @return void
	 */
	public function testWithAttributeSetsAttribute(): void {
		$Stub = (object)[];
		$old = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];
		$new = [
			"Hurr" => $Stub,
			"Durrrr" => $old["Durrrr"],
		];
		$RC = new ReflectionClass(Response::class);
		$Property = $RC->getProperty("attributes");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $old);

		$Obj = $Sut->withAttribute("Hurr", $Stub);

		$this->assertSame($old, $Property->getValue($Sut));
		$this->assertSame($new, $Property->getValue($Obj));
	}

	/**
	 * @covers ::withoutAttribute
	 *
	 * @return void
	 */
	public function testWithoutAttributeReturnsClone(): void {
		$RC = new ReflectionClass(Response::class);
		$Sut = $RC->newInstanceWithoutConstructor();

		$Result = $Sut->withoutAttribute("LOL");

		$this->assertInstanceOf(Response::class, $Result);
		$this->assertNotSame($Sut, $Result);
	}

	/**
	 * @covers ::withoutAttribute
	 *
	 * @return void
	 */
	public function testWithoutAttributeUnsetsAttribute(): void {
		$old = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];
		$new = [
			"Durrrr" => $old["Durrrr"],
		];
		$RC = new ReflectionClass(Response::class);
		$Property = $RC->getProperty("attributes");
		$Sut = $RC->newInstanceWithoutConstructor();

		$Property->setAccessible(true);
		$Property->setValue($Sut, $old);

		$Obj = $Sut->withoutAttribute("Hurr");

		$this->assertSame($old, $Property->getValue($Sut));
		$this->assertSame($new, $Property->getValue($Obj));
	}

}

/* vi:set ts=4 sw=4 noet: */
