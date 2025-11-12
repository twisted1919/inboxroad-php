<?php

declare(strict_types=1);

namespace Inboxroad\Models;

use StdClass;

/**
 * Class Message
 * @package Inboxroad\Models
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    private string $messageId = '';

    /**
     * @var string
     */
    private string $fromEmail = '';

    /**
     * @var string
     */
    private string $fromName = '';

    /**
     * @var string
     */
    private string $toEmail = '';

    /**
     * @var string
     */
    private string $toName = '';

    /**
     * @var string
     */
    private string $replyToEmail = '';

    /**
     * @var string
     */
    private string $subject = '';

    /**
     * @var string
     */
    private string $text = '';

    /**
     * @var string
     */
    private string $html = '';

    /**
     * @var MessageHeaderCollectionInterface
     */
    private MessageHeaderCollectionInterface $headers;

    /**
     * @var MessageAttachmentCollectionInterface
     */
    private MessageAttachmentCollectionInterface $attachments;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->headers     = new MessageHeaderCollection();
        $this->attachments = new MessageAttachmentCollection();
    }

    /**
     * @param string $messageId
     *
     * @return MessageInterface
     */
    public function setMessageId(string $messageId): MessageInterface
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @param string $email
     *
     * @return MessageInterface
     */
    public function setFromEmail(string $email): MessageInterface
    {
        $this->fromEmail = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    /**
     * @param string $name
     *
     * @return MessageInterface
     */
    public function setFromName(string $name): MessageInterface
    {
        $this->fromName = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @param string $email
     *
     * @return MessageInterface
     */
    public function setToEmail(string $email): MessageInterface
    {
        $this->toEmail = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getToEmail(): string
    {
        return $this->toEmail;
    }

    /**
     * @param string $name
     *
     * @return MessageInterface
     */
    public function setToName(string $name): MessageInterface
    {
        $this->toName = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getToName(): string
    {
        return $this->toName;
    }

    /**
     * @param string $email
     *
     * @return MessageInterface
     */
    public function setReplyToEmail(string $email): MessageInterface
    {
        $this->replyToEmail = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplyToEmail(): string
    {
        return $this->replyToEmail;
    }

    /**
     * @param string $subject
     *
     * @return MessageInterface
     */
    public function setSubject(string $subject): MessageInterface
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $text
     *
     * @return MessageInterface
     */
    public function setText(string $text): MessageInterface
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $html
     *
     * @return MessageInterface
     */
    public function setHtml(string $html): MessageInterface
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param MessageHeaderCollectionInterface $headers
     *
     * @return MessageInterface
     */
    public function setHeaders(MessageHeaderCollectionInterface $headers): MessageInterface
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return MessageHeaderCollectionInterface
     */
    public function getHeaders(): MessageHeaderCollectionInterface
    {
        return $this->headers;
    }

    /**
     * @param MessageAttachmentCollectionInterface $attachments
     *
     * @return MessageInterface
     */
    public function setAttachments(MessageAttachmentCollectionInterface $attachments): MessageInterface
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * @return MessageAttachmentCollectionInterface
     */
    public function getAttachments(): MessageAttachmentCollectionInterface
    {
        return $this->attachments;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'fromEmail'     => $this->getFromEmail(),
            'fromName'      => $this->getFromName(),
            'toEmail'       => $this->getToEmail(),
            'toName'        => $this->getToName(),
            'replyToEmail'  => $this->getReplyToEmail(),
            'subject'       => $this->getSubject(),
            'text'          => $this->getText(),
            'html'          => $this->getHtml(),
            'headers'       => $this->getHeaders()->toArray(),
            'attachments'   => $this->getAttachments()->toArray(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toInboxroadArray(): array
    {
        $headers = $this->getHeaders()->toInboxroadArray();
        if (empty($headers)) {
            $headers = new StdClass();
        }

        return [
            'from_email'    => $this->getFromEmail(),
            'from_name'     => $this->getFromName(),
            'to_email'      => $this->getToEmail(),
            'to_name'       => $this->getToName(),
            'reply_to_email' => $this->getReplyToEmail(),
            'subject'       => $this->getSubject(),
            'text'          => $this->getText(),
            'html'          => $this->getHtml(),
            'headers'       => $headers,
            'attachments'   => $this->getAttachments()->toInboxroadArray(),
        ];
    }

    /**
     * @param array<string, mixed> $params
     *
     * @return MessageInterface
     */
    public static function fromArray(array $params): MessageInterface
    {
        return (new self())
            /** @phpstan-ignore-next-line argument.type */
            ->setFromEmail($params['fromEmail'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setFromName($params['fromName'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setToEmail($params['toEmail'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setToName($params['toName'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setReplyToEmail($params['replyToEmail'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setSubject($params['subject'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setText($params['text'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setHtml($params['html'] ?? '')
            /** @phpstan-ignore-next-line argument.type */
            ->setHeaders(MessageHeaderCollection::fromArray($params['headers'] ?? []))
            /** @phpstan-ignore-next-line argument.type */
            ->setAttachments(MessageAttachmentCollection::fromArray($params['attachments'] ?? []));
    }
}
