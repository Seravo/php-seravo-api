<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Exception\RequestException;
use Psr\Http\Message\UriInterface;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;
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
        $uri = $uri->withPath(rtrim($uri->getPath(), '/') . '/' . $this->endPointPrefix->value . '/');

        $this->uri = $uri;

        return (string) $this->uri . $endpoint->value . '/';
    }

    /**
     * @template T of SeravoResponseInterface
     * @param class-string<T> $responseClass
     * @param string $uri
     * @return array<int, T> | T
     */
    public function get(string $responseClass, string $uri): SeravoResponseInterface|array
    {
        return $this->request($responseClass, HttpMethod::Get, $uri);
    }

    /**
     * @template T of SeravoResponseInterface
     * @param class-string<T> $responseClass
     * @param string $uri
     * @param mixed $body
     * @return T
     */
    public function post(string $responseClass, string $uri, mixed $body): SeravoResponseInterface
    {
        return $this->request($responseClass, HttpMethod::Post, $uri, $body);
    }

    /**
     * @template T of SeravoResponseInterface
     * @param class-string<T> $responseClass
     * @param string $uri
     * @param mixed $body
     * @return T
     */
    public function put(string $responseClass, string $uri, mixed $body): SeravoResponseInterface
    {
        return $this->request($responseClass, HttpMethod::Put, $uri, $body);
    }

    /**
     * @template T of SeravoResponseInterface
     * @param class-string<T> $responseClass
     * @param string $uri
     * @param mixed $body
     * @return T
     */
    public function patch(string $responseClass, string $uri, mixed $body): SeravoResponseInterface
    {
        return $this->request($responseClass, HttpMethod::Patch, $uri, $body);
    }

    /**
     * @template T of SeravoResponseInterface
     * @param class-string<T> $responseClass
     * @param HttpMethod $method
     * @param string $uri
     * @param array<string, string> $headers
     * @param mixed $body
     * @return array<int, T> | T
     */
    private function request(
        string $responseClass,
        HttpMethod $method,
        string $uri,
        mixed $body = null,
        array $headers = [],
    ): SeravoResponseInterface|array {
        try {
            $response = $this->getHttpClient()->send($method->value, $uri, $headers, json_encode($body));
        } catch (RequestException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }

        return ResponseFormatter::format($response->getBody()->getContents(), $responseClass);
    }
}
