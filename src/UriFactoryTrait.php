<?php

namespace Laz0r\Http;

use Psr\Http\Message\UriFactoryInterface;

trait UriFactoryTrait {

	private UriFactoryInterface $UriFactory;

	protected function getUriFactory(): UriFactoryInterface {
		return $this->UriFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
