<?php

namespace Laz0r\Http;

use Psr\Http\Message\RequestFactoryInterface;

trait RequestFactoryTrait {

	private RequestFactoryInterface $RequestFactory;

	protected function getRequestFactory(): RequestFactoryInterface {
		return $this->RequestFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
