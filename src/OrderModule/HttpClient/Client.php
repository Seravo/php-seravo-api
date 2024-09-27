<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\HttpClient;

use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;

use RuntimeException;

final class Client
{
    private ClientInterface $client;

    public function __construct(string $baseUrl, string $OidcToken)
    {
        $this->createClient($baseUrl, $OidcToken);
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->client;
    }

    private function createClient(string $baseUrl, string $OidcToken): void
    {
        $handlerStack = HandlerStack::create(null);

        $config = [
            'base_uri' => rtrim($baseUrl, '/') . '/',
            'handler' => $handlerStack,
        ];

        $handlerStack->push(Middleware::mapRequest(static function (RequestInterface $request) use ($OidcToken) {
            return $request->withHeader('Authorization', "Bearer {$OidcToken}");
        }));

        $this->client = new GuzzleHttpClient($config);
    }
}
