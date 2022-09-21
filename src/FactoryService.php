<?php

namespace Laz0r\Http;

use Laminas\Diactoros\{
	Request,
	ServerRequest,
	Stream,
	UploadedFile,
	Uri,
};
use Laz0r\Util\CreateObjectTrait;
use Psr\Http\Message\{
	RequestFactoryInterface,
	RequestInterface,
	ServerRequestFactoryInterface,
	ServerRequestInterface,
	StreamFactoryInterface,
	StreamInterface,
	UploadedFileFactoryInterface,
	UploadedFileInterface,
	UriFactoryInterface,
	UriInterface,
};
use const UPLOAD_ERR_OK;

class FactoryService implements
	DispatcherFactoryInterface,
	RequestFactoryInterface,
	ResponseFactoryInterface,
	ServerRequestFactoryInterface,
	StreamFactoryInterface,
	UploadedFileFactoryInterface,
	UriFactoryInterface {

	use CreateObjectTrait;

	protected const QCN_DISPATCHER = Dispatcher::class;
	protected const QCN_REQUEST = Request::class;
	protected const QCN_RESPONSE = Response::class;
	protected const QCN_SERVERREQUEST = ServerRequest::class;
	protected const QCN_STREAM = Stream::class;
	protected const QCN_UPLOADEDFILE = UploadedFile::class;
	protected const QCN_URI = Uri::class;

	public function createDispatcher(
		RequestHandlerInterface $RequestHandler,
		ServerRequestInterface $ServerRequest
	): DispatcherInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_DISPATCHER;
		$Ret = $this->createObject($qcn, $RequestHandler, $ServerRequest);

		assert($Ret instanceof DispatcherInterface);

		return $Ret;
	}

	public function createRequest(string $method, $uri): RequestInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_REQUEST;
		$Ret = $this->createObject($qcn, $uri, $method);

		assert($Ret instanceof RequestInterface);

		return $Ret;
	}

	public function createResponse(
		int $code = 200,
		string $reasonPhrase = ""
	): ResponseInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_RESPONSE;
		$Response = $this->createObject($qcn);

		assert($Response instanceof ResponseInterface);

		$Ret = $Response->withStatus($code, $reasonPhrase);

		assert($Ret instanceof ResponseInterface);

		return $Ret;
	}

	public function createServerRequest(
		string $method,
		$uri,
		array $serverParams = []
	): ServerRequestInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_SERVERREQUEST;
		$Ret = $this->createObject(
			$qcn,
			$serverParams,
			[],
			$uri,
			$method,
			"php://memory",
		);

		assert($Ret instanceof ServerRequestInterface);

		return $Ret;
	}

	public function createStream(string $content = ""): StreamInterface {
		$r = fopen("php://memory", "w+");
		fputs($r, $content);
		fflush($r);
		rewind($r);

		return $this->createStreamFromResource($r);
	}

	public function createStreamFromFile(
		string $filename,
		string $mode = "r"
	): StreamInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_STREAM;
		$Ret = $this->createObject($qcn, $filename, $mode);

		assert($Ret instanceof StreamInterface);

		return $Ret;
	}

	public function createStreamFromResource($resource): StreamInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_STREAM;
		$Ret = $this->createObject($qcn, $resource);

		assert($Ret instanceof StreamInterface);

		return $Ret;
	}

	public function createUploadedFile(
		StreamInterface $stream,
		?int $size = null,
		int $error = UPLOAD_ERR_OK,
		?string $clientFilename = null,
		?string $clientMediaType = null
	): UploadedFileInterface {
		$size ??= $stream->getSize();
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_UPLOADEDFILE;
		$Ret = $this->createObject(
			$qcn,
			$stream,
			$size,
			$error,
			$clientFilename,
			$clientMediaType,
		);

		assert($Ret instanceof UploadedFileInterface);

		return $Ret;
	}

	public function createUri(string $uri = ""): UriInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_URI;
		$Ret = $this->createObject($qcn, $uri);

		assert($Ret instanceof UriInterface);

		return $Ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
