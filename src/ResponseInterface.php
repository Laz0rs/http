<?php

namespace Laz0r\Http;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\StreamInterface;

interface ResponseInterface extends PsrResponseInterface {

	/**
	 * @return array
	 * @psalm-return array<string, mixed>
	 */
	public function getAttributes(): array;

	/**
	 * @param string $name
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	public function getAttribute(string $name, $default = null);

	/**
	 * @param string          $name
	 * @param string|string[] $value
	 *
	 * @return static
	 * @throws \InvalidArgumentException
	 */
	public function withAddedHeader($name, $value);

	/**
	 * @param string $name
	 * @param mixed  $value
	 *
	 * @return static
	 */
	public function withAttribute(string $name, $value): self;

	/**
	 * @param \Psr\Http\Message\StreamInterface $Body
	 *
	 * @return static
	 * @psalm-suppress ParamNameMismatch
	 */
	public function withBody(StreamInterface $Body);

	/**
	 * @param string          $name
	 * @param string|string[] $value
	 *
	 * @return static
	 * @throws \InvalidArgumentException
	 */
	public function withHeader($name, $value);

	/**
	 * @param string $version
	 *
	 * @return static
	 */
	public function withProtocolVersion($version);

	/**
	 * @param int    $code
	 * @param string $reasonPhrase
	 *
	 * @return static
	 * @throws \InvalidArgumentException
	 */
	public function withStatus($code, $reasonPhrase = "");

	/**
	 * @param string $name
	 *
	 * @return static
	 */
	public function withoutAttribute(string $name): self;

	public function withoutHeader($name);

}

/* vi:set ts=4 sw=4 noet: */
