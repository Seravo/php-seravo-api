<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Api;

use Psr\Http\Message\ResponseInterface;
use Seravo\SeravoApi\OrderModule\Client;

abstract class AbstractApi
{

    public function __construct(
        protected Client $client
    ) {
    }

    /**
     * Undocumented function
     *
     * @param string $method
     * @param array<string, mixed> $params
     * @return ResponseInterface
     */
    protected function request(string $method, array $params = []): ResponseInterface
    {
        $response = $this->client->getHttpClient()->request(method: $method, options: $params);
        return $response;
    }

    protected function getClient(): Client
    {
        return $this->client;
    }
}
