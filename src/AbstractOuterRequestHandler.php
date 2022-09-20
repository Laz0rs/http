<?php

namespace Laz0r\Http;

use Laz0r\Util\AbstractConstructOnce;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractOuterRequestHandler extends AbstractConstructOnce implements OuterRequestHandlerInterface {

	private RequestHandlerInterface $Handler;

	public function __construct(RequestHandlerInterface $Handler) {
		parent::__construct();

		$this->Handler = $Handler;
	}

	public function getInnerRequestHandler(): RequestHandlerInterface {
		return $this->Handler;
	}

	abstract public function handle(
		ServerRequestInterface $Request
	): ResponseInterface;

}

/* vi:set ts=4 sw=4 noet: */
