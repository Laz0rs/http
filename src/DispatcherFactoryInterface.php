<?php

namespace Laz0r\Http;

use Psr\Http\Message\ServerRequestInterface;

interface DispatcherFactoryInterface {

	public function createDispatcher(
		RequestHandlerInterface $RequestHandler,
		ServerRequestInterface $ServerRequest
	): DispatcherInterface;

}

/* vi:set ts=4 sw=4 noet: */
