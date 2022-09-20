<?php

namespace Laz0r\Http;

interface OuterRequestHandlerInterface extends RequestHandlerInterface {

	public function getInnerRequestHandler(): RequestHandlerInterface;

}

/* vi:set ts=4 sw=4 noet: */
