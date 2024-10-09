<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Seravo\SeravoApi\AuthProvider;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\HttpClient\Plugin\Authentication;
use Seravo\SeravoApi\HttpClient\Plugin\ContentType;

final class SeravoAPI
{
    public function __construct(
        public readonly string $baseUrl,
        public readonly string $clientId,
        public readonly string $secret,
        private ?Builder $httpClientBuilder = null
    ) {
        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
        $this->setDefaultHttpPlugins();
    }

    public function authenticate(string $authProviderUrl, string $tokenEndpoint): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(
            new Authentication(
                new AuthProvider(
                    clientId: $this->clientId,
                    secret: $this->secret,
                    providerUrl: $authProviderUrl,
                    tokenEndpoint: $tokenEndpoint
                )
            )
        );
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    private function setDefaultHttpPlugins(): void
    {
        $this->httpClientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'accept' => 'application/json'
        ]));

        $this->httpClientBuilder->addPlugin(new ContentType());
    }
}
