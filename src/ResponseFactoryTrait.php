<?php

namespace Laz0r\Http;

trait ResponseFactoryTrait {

	private ResponseFactoryInterface $ResponseFactory;

	protected function getResponseFactory(): ResponseFactoryInterface {
		return $this->ResponseFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
