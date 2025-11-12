<?php

declare(strict_types=1);

namespace Inboxroad\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RequestException
 * @package Inboxroad\Exception
 */
class RequestException extends Exception
{
    /**
     * ClientException constructor.
     *
     * @param string $message
     * @param int $code
     * @param RequestInterface|null $request
     * @param ResponseInterface|null $response
     */
    public function __construct(
        string $message,
        int $code,
        private readonly ?RequestInterface $request = null,
        private readonly ?ResponseInterface $response = null
    ) {
        parent::__construct($message, $code);
    }

    /**
     * @return bool
     */
    public function hasRequest(): bool
    {
        return !empty($this->request);
    }

    /**
     * @return null|RequestInterface
     */
    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * @return bool
     */
    public function hasResponse(): bool
    {
        return !empty($this->response);
    }

    /**
     * @return null|ResponseInterface
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
