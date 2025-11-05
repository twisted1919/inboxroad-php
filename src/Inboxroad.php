<?php

declare(strict_types=1);

namespace Inboxroad;

use Inboxroad\Api\Messages;
use Inboxroad\Api\MessagesInterface;
use Inboxroad\HttpClient\HttpClient;

/**
 * Class Inboxroad
 * @package Inboxroad
 */
readonly class Inboxroad implements InboxroadInterface
{
    /**
     * Inboxroad constructor.
     *
     * @param HttpClient $httpClient
     */
    public function __construct(private HttpClient $httpClient)
    {
    }

    /**
     * @return MessagesInterface
     */
    public function messages(): MessagesInterface
    {
        return new Messages($this->httpClient);
    }
}
