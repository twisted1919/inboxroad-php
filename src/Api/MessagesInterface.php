<?php

declare(strict_types=1);

namespace Inboxroad\Api;

use Inboxroad\Exception\RequestException;
use Inboxroad\Models\MessageInterface;
use Inboxroad\Response\MessagesResponse;

/**
 * Class Messages
 * @package Inboxroad
 */
interface MessagesInterface
{
    /**
     * @param MessageInterface|array<string, mixed> $message
     *
     * @return MessagesResponse
     * @throws RequestException
     */
    public function send(array|MessageInterface $message): MessagesResponse;
}
