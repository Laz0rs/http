<?php

namespace Laz0r\Http;

use Laz0r\Util\AbstractConstructOnce;
use Psr\Http\Message\ServerRequestInterface;

class Dispatcher extends AbstractConstructOnce implements DispatcherInterface {

	private RequestHandlerInterface $RequestHandler;
	private ServerRequestInterface $ServerRequest;

	public function __construct(
		RequestHandlerInterface $RequestHandler,
		ServerRequestInterface $ServerRequest
	) {
		parent::__construct();

		$this->RequestHandler = $RequestHandler;
		$this->ServerRequest = $ServerRequest;
	}

	public function dispatch(): ResponseInterface {
		return $this->getRequestHandler()
			->handle($this->getServerRequest());
	}

	protected function getRequestHandler(): RequestHandlerInterface {
		return $this->RequestHandler;
	}

	protected function getServerRequest(): ServerRequestInterface {
		return $this->ServerRequest;
	}

}

/* vi:set ts=4 sw=4 noet: */
