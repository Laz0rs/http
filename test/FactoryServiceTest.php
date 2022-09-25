<?php

namespace Laz0r\HttpTest;

use Laz0r\Http\{
	DispatcherInterface,
	FactoryService,
	RequestHandlerInterface,
	ResponseInterface,
};
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\{
	RequestInterface,
	ServerRequestInterface,
	StreamInterface,
	UploadedFileInterface,
	UriInterface,
};

/**
 * @coversDefaultClass \Laz0r\Http\FactoryService
 */
class FactoryServiceTest extends TestCase {

	/**
	 * @covers ::createDispatcher
	 *
	 * @return void
	 */
	public function testCreateDispatcher(): void {
		$Dispatcher = $this->createStub(DispatcherInterface::class);
		$RequestHandler = $this->createStub(RequestHandlerInterface::class);
		$ServerRequest = $this->createStub(ServerRequestInterface::class);
		$Sut = new class($Dispatcher) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_DISPATCHER = DispatcherInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};

		$Result = $Sut->createDispatcher($RequestHandler, $ServerRequest);
		$this->assertSame($Dispatcher, $Result);

		$this->assertSame(DispatcherInterface::class, $Sut->qcn);

		$Result = array_pop($Sut->args);
		$this->assertSame($ServerRequest, $Result);

		$Result = array_pop($Sut->args);
		$this->assertSame($RequestHandler, $Result);
	}

	/**
	 * @covers ::createRequest
	 *
	 * @return void
	 */
	public function testCreateRequest(): void {
		$Stub = (object)[];
		$Request = $this->createStub(RequestInterface::class);
		$Sut = new class($Request) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_REQUEST = RequestInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};

		$Result = $Sut->createRequest("DERP", $Stub);
		$this->assertSame($Request, $Result);

		$this->assertSame(RequestInterface::class, $Sut->qcn);

		$Result = array_pop($Sut->args);
		$this->assertSame("DERP", $Result);

		$Result = array_pop($Sut->args);
		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::createResponse
	 *
	 * @return void
	 */
	public function testCreateResponse(): void {
		$Mock = $this->createStub(ResponseInterface::class);
		$Stub = $this->createStub(ResponseInterface::class);
		$Sut = new class($Mock) extends FactoryService {

			public string $qcn = "";

			protected const QCN_RESPONSE = ResponseInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;

				return $this->Ret;
			}

		};

		$Mock->expects($this->once())
			->method("withStatus")
			->with(
				$this->identicalTo(555),
				$this->identicalTo("Laz0r"),
			)
			->will($this->returnValue($Stub));

		$Result = $Sut->createResponse(555, "Laz0r");
		$this->assertSame($Stub, $Result);

		$this->assertSame(ResponseInterface::class, $Sut->qcn);
	}

	/**
	 * @covers ::createServerRequest
	 *
	 * @return void
	 */
	public function testCreateServerRequest(): void {
		$Obj = (object)[];
		$Stub = $this->createStub(ServerRequestInterface::class);
		$Sut = new class($Stub) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_SERVERREQUEST = ServerRequestInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};
		$param = [
			"Hurr" => (object)[],
			"Durrrr" => (object)[],
		];

		$Result = $Sut->createServerRequest("DERP", $Obj, $param);
		$this->assertSame($Stub, $Result);

		$this->assertSame(ServerRequestInterface::class, $Sut->qcn);

		$arg = array_pop($Sut->args);
		$this->assertSame("php://memory", $arg);

		$arg = array_pop($Sut->args);
		$this->assertSame("DERP", $arg);

		$Result = array_pop($Sut->args);
		$this->assertSame($Obj, $Result);

		$arg = array_pop($Sut->args);
		$this->assertSame([], $arg);

		$arg = array_pop($Sut->args);
		$this->assertSame($param, $arg);
	}

	/**
	 * @covers ::createStream
	 *
	 * @return void
	 */
	public function testCreateStream(): void {
		$Stub = $this->createStub(StreamInterface::class);
		$Sut = $this->getMockBuilder(FactoryService::class)
			->onlyMethods(["createStreamFromResource"])
			->getMock();

		$Sut->expects($this->once())
			->method("createStreamFromResource")
			->with($this->isType("resource"))
			->will($this->returnValue($Stub));

		$Result = $Sut->createStream(file_get_contents(__FILE__));

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::createStreamFromFile
	 *
	 * @return void
	 */
	public function testCreateStreamFromFile(): void {
		$Stub = $this->createStub(StreamInterface::class);
		$Sut = new class($Stub) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_STREAM = StreamInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};

		$Result = $Sut->createStreamFromFile("/etc/passwd", "wb");
		$this->assertSame($Stub, $Result);

		$arg = array_pop($Sut->args);
		$this->assertSame("wb", $arg);

		$arg = array_pop($Sut->args);
		$this->assertSame("/etc/passwd", $arg);
	}

	/**
	 * @covers ::createStreamFromResource
	 *
	 * @return void
	 */
	public function testCreateStreamFromResource(): void {
		$Obj = (object)[];
		$Stub = $this->createStub(StreamInterface::class);
		$Sut = new class($Stub) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_STREAM = StreamInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};

		$Result = $Sut->createStreamFromResource($Obj);
		$this->assertSame($Stub, $Result);

		$arg = array_pop($Sut->args);
		$this->assertSame($Obj, $arg);
	}

	/**
	 * @covers ::createUploadedFile
	 *
	 * @return void
	 */
	public function testCreateUploadedFile(): void {
		$Stream = $this->createStub(StreamInterface::class);
		$Stub = $this->createStub(UploadedFileInterface::class);
		$Sut = new class($Stub) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_UPLOADEDFILE = UploadedFileInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};

		$Result = $Sut->createUploadedFile(
			$Stream,
			0xdead,
			0xbeef,
			__FILE__,
			"herpus/derpus",
		);
		$this->assertSame($Stub, $Result);

		$arg = array_pop($Sut->args);
		$this->assertSame("herpus/derpus", $arg);

		$arg = array_pop($Sut->args);
		$this->assertSame(__FILE__, $arg);

		$arg = array_pop($Sut->args);
		$this->assertSame(0xbeef, $arg);

		$arg = array_pop($Sut->args);
		$this->assertSame(0xdead, $arg);

		$Result = array_pop($Sut->args);
		$this->assertSame($Stream, $Result);
	}

	/**
	 * @covers ::createUri
	 *
	 * @return void
	 */
	public function testCreateUri(): void {
		$Stub = $this->createStub(UriInterface::class);
		$Sut = new class($Stub) extends FactoryService {

			public array $args = [];

			public string $qcn = "";

			protected const QCN_URI = UriInterface::class;

			private object $Ret;

			public function __construct(object $Ret) {
				$this->Ret = $Ret;
			}

			protected function createObject(string $qcn, ...$args): object {
				$this->qcn = $qcn;
				$this->args = $args;

				return $this->Ret;
			}

		};

		$Result = $Sut->createUri("https://youtu.be/xm3YgoEiEDc");
		$this->assertSame($Stub, $Result);

		$arg = array_pop($Sut->args);
		$this->assertSame("https://youtu.be/xm3YgoEiEDc", $arg);
	}

}

/* vi:set ts=4 sw=4 noet: */
