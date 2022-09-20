<?php

namespace Laz0r\Http;

use Psr\Http\Message\StreamFactoryInterface;

trait StreamFactoryTrait {

	private StreamFactoryInterface $StreamFactory;

	protected function getStreamFactory(): StreamFactoryInterface {
		return $this->StreamFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
