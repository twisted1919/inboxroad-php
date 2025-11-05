<?php

declare(strict_types=1);

namespace Inboxroad\HttpClient;

/**
 * Class HttpResponse
 * @package Inboxroad\HttpClient
 */
class HttpResponse implements HttpResponseInterface
{
    /**
     * @var array<string, mixed>
     */
    private readonly array $responseData;

    /**
     * @param string $body
     * @param int $code
     * @param array<int, mixed> $headers
     */
    public function __construct(
        private readonly string $body,
        private readonly int $code,
        private readonly array $headers = []
    ) {
        /** @phpstan-ignore-next-line assign.propertyType */
        $this->responseData = (array)json_decode($this->body, true);
    }

    /**
     * @param HttpResponseInterface $response
     *
     * @return HttpResponseInterface
     */
    public static function fromResponse(HttpResponseInterface $response): HttpResponseInterface
    {
        return new static($response->getBody(), $response->getCode(), $response->getHeaders());
    }

    /**
     * @return array<string, mixed>
     *
     */
    public function getResponseData(): array
    {
        /** @phpstan-ignore-next-line return.type */
        return $this->responseData;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array<int, mixed>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
