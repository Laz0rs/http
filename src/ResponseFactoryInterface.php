<?php

namespace Laz0r\Http;

use Psr\Http\Message\ResponseFactoryInterface as ResponseFactoryInterfaceBase;

interface ResponseFactoryInterface extends ResponseFactoryInterfaceBase {

	public function createResponse(
		int $code = 200,
		string $reasonPhrase = ""
	): ResponseInterface;

}

/* vi:set ts=4 sw=4 noet: */
