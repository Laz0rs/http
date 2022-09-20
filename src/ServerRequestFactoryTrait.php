<?php

namespace Laz0r\Http;

use Psr\Http\Message\ServerRequestFactoryInterface;

trait ServerRequestFactoryTrait {

	private ServerRequestFactoryInterface $ServerRequestFactory;

	protected function getServerRequestFactory(): ServerRequestFactoryInterface {
		return $this->ServerRequestFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
