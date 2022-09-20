<?php

namespace Laz0r\Http;

trait RequestHandlerTrait {

	private RequestHandlerInterface $RequestHandler;

	protected function getRequestHandler(): RequestHandlerInterface {
		return $this->RequestHandler;
	}

}

/* vi:set ts=4 sw=4 noet: */
