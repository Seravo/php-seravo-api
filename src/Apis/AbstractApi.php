<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Exception\RequestException;
use Psr\Http\Message\UriInterface;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\ApiModule;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Exception\ApiException;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\HttpClient\Formatter\ResponseFormatter;

abstract class AbstractApi
{
    private UriInterface $uri;

    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder,
        private readonly ApiModule $endPointPrefix
    ) {
        $this->setUri($this->endPointPrefix);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    public function setUri(ApiModule|ApiEndpoint $endpoint): string
    {
        $uri = $this->httpClientBuilder->getUriFactory()->createUri($this->baseUrl);
        $uri = $uri->withPath(rtrim($uri->getPath(), '/') . $this->endPointPrefix->value . '/');

        $this->uri = $uri;

        return (string) $this->uri . $endpoint->value . '/';
    }

    /**
     * @param array<mixed, mixed> $headers
     * @return array<string, mixed>
     */
    public function request(HttpMethod $method, string $uri, array $headers = [], mixed $body = null): array
    {
        try {
            $response = $this->getHttpClient()->send($method->value, $uri, $headers, json_encode($body));
        } catch (RequestException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }

        return ResponseFormatter::format($response);
    }
}
