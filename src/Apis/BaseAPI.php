<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Http\Client\Common\HttpMethodsClientInterface;
use Seravo\SeravoApi\HttpClient\Builder;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Exception\RequestException;
use Psr\Http\Message\UriInterface;
use Seravo\SeravoApi\Exception\ApiException;
use Seravo\SeravoApi\HttpClient\Formatter\ResponseFormatter;

abstract class BaseAPI
{
    private UriInterface $uri;

    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder,
        private readonly string $endPointPrefix
    ) {
        $this->setUri();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    public function getUri(string $endpoint): string
    {
        return (string) $this->uri . $endpoint . '/';
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    /**
     * @param array<mixed, mixed> $headers
     * @return array<string, mixed>
     */
    public function request(string $method, string $uri, array $headers = [], mixed $body = null): array
    {
        try {
            $response = $this->getHttpClient()->send($method, $uri, $headers, $body);
        } catch (RequestException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }

        return ResponseFormatter::format($response);
    }

    private function setUri(): void
    {
        $uri = $this->httpClientBuilder->getUriFactory()->createUri($this->baseUrl);
        $uri = $uri->withPath(rtrim($uri->getPath(), '/') . $this->endPointPrefix);

        $this->uri = $uri;
    }
}
