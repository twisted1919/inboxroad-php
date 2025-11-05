<?php

declare(strict_types=1);

namespace Inboxroad\HttpClient;

use ErrorException;
use GuzzleHttp\Client;
use Inboxroad\Exception\RequestException;
use Throwable;

/**
 * Class HttpClient
 * @package Inboxroad\HttpClient
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var string
     */
    protected string $apiKey = '';

    /**
     * @var array<string, mixed>
     */
    private static array $options = [
        'base_uri' => 'https://webapi.inboxroad.com/api/v1/',
        'headers'  => [
            'Content-Type'  => 'application/json',
            'User-Agent'    => 'inboxroad-api/inboxroad-php'
        ],
    ];

    /**
     * HttpClient constructor.
     *
     * @param string $apiKey
     * @param array<string, mixed> $options
     *
     * @throws ErrorException
     */
    public function __construct(string $apiKey = '', array $options = [])
    {
        if (empty($apiKey)) {
            throw new ErrorException('Please provide a valid api key!');
        }
        $this->apiKey = $apiKey;

        $options = array_merge_recursive(self::$options, $options);

        /** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
        if (empty($options['headers']['Authorization'])) {
            /** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
            $options['headers']['Authorization'] = sprintf('Basic %s', $apiKey);
        }

        $this->client = new Client($options);
    }

    /**
     * @param string $path
     * @param array<string, mixed> $options
     *
     * @return HttpResponseInterface
     * @throws RequestException
     */
    public function get(string $path = '', array $options = []): HttpResponseInterface
    {
        try {
            $response = $this->client->get($path, $options);
            /** @phpstan-ignore-next-line argument.type */
            $response = new HttpResponse((string)$response->getBody(), $response->getStatusCode(), $response->getHeaders());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e->getRequest(), $e->getResponse());
        } catch (Throwable $e) {
            throw new RequestException($e->getMessage(), $e->getCode());
        }

        return $response;
    }

    /**
     * @param string $path
     * @param array<string, mixed> $options
     *
     * @return HttpResponseInterface
     * @throws RequestException
     */
    public function post(string $path = '', array $options = []): HttpResponseInterface
    {
        try {
            $response = $this->client->post($path, $options);
            /** @phpstan-ignore-next-line argument.type */
            $response = new HttpResponse((string)$response->getBody(), $response->getStatusCode(), $response->getHeaders());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e->getRequest(), $e->getResponse());
        } catch (Throwable $e) {
            throw new RequestException($e->getMessage(), $e->getCode());
        }

        return $response;
    }
}
