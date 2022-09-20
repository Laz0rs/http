<?php

namespace Laz0r\Http;

use Psr\Http\Message\UploadedFileFactoryInterface;

trait UploadedFileFactoryTrait {

	private UploadedFileFactoryInterface $UploadedFileFactory;

	protected function getUploadedFileFactory(): UploadedFileFactoryInterface {
		return $this->UploadedFileFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
