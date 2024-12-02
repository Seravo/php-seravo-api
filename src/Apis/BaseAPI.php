<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Exception\RequestException;
use Psr\Http\Message\UriInterface;
use Seravo\SeravoApi\Concerns\ArrayRemoveNullValues;
use Seravo\SeravoApi\Exception\ApiException;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\HttpClient\Formatter\ResponseFormatter;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class BaseAPI
{
    use ArrayRemoveNullValues;
  
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
            if (!is_null($body)) {
                $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
                $serializer = new Serializer([$normalizer]);
                $body = json_encode($this->arrayFilterRecursive($serializer->normalize($body)));
            }

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
