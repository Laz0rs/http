<?php

namespace Laz0r\Http;

use Psr\Http\Message\ServerRequestInterface;

interface RequestHandlerInterface {

	public function handle(ServerRequestInterface $Request): ResponseInterface;

}

/* vi:set ts=4 sw=4 noet: */
