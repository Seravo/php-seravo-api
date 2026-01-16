<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use RuntimeException;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Exception\RequestException;
use Psr\Http\Message\UriInterface;
use Seravo\SeravoApi\Contracts\CollectionInterface;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\ApiModule;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Exceptions\InvalidApiResponseException;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\HttpClient\Formatter\ResponseFormatter;
use Seravo\SeravoApi\JsonResponseMapper;

abstract class AbstractApi
{
    private UriInterface $uri;

    private ResponseFormatter $responseFormatter;

    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder,
        private readonly ApiModule $endPointPrefix
    ) {
        $this->setUri($this->endPointPrefix);
        $this->responseFormatter = new ResponseFormatter(new JsonResponseMapper());
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
     * @template T of SeravoResponseInterface|CollectionInterface
     * @param class-string<T> $responseClass
     * @param string $uri
     * @return T
     */
    public function get(string $responseClass, string $uri): SeravoResponseInterface|CollectionInterface
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
     * @template T of SeravoResponseInterface|CollectionInterface
     * @param class-string<T> $responseClass
     * @param HttpMethod $method
     * @param string $uri
     * @param array<string, string> $headers
     * @param string $body
     * @return T
     */
    private function request(
        string $responseClass,
        HttpMethod $method,
        string $uri,
        mixed $body = null,
        array $headers = [],
    ): SeravoResponseInterface|CollectionInterface {
        try {
            $encodedBody = $body ? json_encode($body) : null;
            if ($encodedBody === false) {
                throw new RuntimeException('Failed to encode body to JSON');
            }
            $response = $this->getHttpClient()->send($method->value, $uri, $headers, $encodedBody);
        } catch (RequestException $e) {
            throw new InvalidApiResponseException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->responseFormatter->format($response->getBody()->getContents(), $responseClass);
    }
}
