<?php

declare(strict_types=1);

namespace Inboxroad\Api;

use Inboxroad\Exception\RequestException;
use Inboxroad\HttpClient\HttpClient;
use Inboxroad\HttpClient\HttpResponse;
use Inboxroad\Models\Message;
use Inboxroad\Models\MessageInterface;
use Inboxroad\Response\MessagesResponse;

/**
 * Class Messages
 * @package Inboxroad
 */
readonly class Messages implements MessagesInterface
{
    /**
     * Messages constructor.
     *
     * @param HttpClient $httpClient
     */
    public function __construct(private HttpClient $httpClient)
    {
    }

    /**
     * @param MessageInterface|array $message
     *
     * @return MessagesResponse
     * @throws RequestException
     *
     * @phpstan-ignore-next-line missingType.iterable
     */
    public function send(array|MessageInterface $message): MessagesResponse
    {
        if (!($message instanceof MessageInterface)) {
            /** @phpstan-ignore-next-line argument.type */
            $message = Message::fromArray($message);
        }

        /** @var HttpResponse $response */
        $response = $this->httpClient->post('messages/', [
            'json' => $message->toInboxroadArray(),
        ]);

        /** @var MessagesResponse $response */
        $response = MessagesResponse::fromResponse($response);

        if ($response->getMessageId()) {
            $message->setMessageId($response->getMessageId());
        }

        return $response;
    }
}
