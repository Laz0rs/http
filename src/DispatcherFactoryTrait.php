<?php

namespace Laz0r\Http;

trait DispatcherFactoryTrait {

	private DispatcherFactoryInterface $DispatcherFactory;

	protected function getDispatcherFactory(): DispatcherFactoryInterface {
		return $this->DispatcherFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
