<?php

namespace Laz0r\Http;

use Laminas\Diactoros\Response as ResponseBase;

class Response extends ResponseBase implements ResponseInterface {

	/** @psalm-var array<string, mixed> */
	private array $attributes = [];

	public function getAttributes(): array {
		return $this->attributes;
	}

	public function getAttribute(string $name, $default = null) {
		if (array_key_exists($name, $this->attributes)) {
			return $this->attributes[$name];
		}

		return $default;
	}

	public function withAttribute(string $name, $value): self {
		$that = clone $this;

		$that->attributes[$name] = $value;

		return $that;
	}

	public function withoutAttribute(string $name): self {
		$that = clone $this;

		unset($that->attributes[$name]);

		return $that;
	}

}

/* vi:set ts=4 sw=4 noet: */
