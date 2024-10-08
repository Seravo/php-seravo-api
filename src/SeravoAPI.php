<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Seravo\SeravoApi\OrderModule\AuthProvider;
use Seravo\SeravoApi\OrderModule\HttpClient\Builder;
use Seravo\SeravoApi\OrderModule\HttpClient\Plugin\Authentication;
use Seravo\SeravoApi\OrderModule\HttpClient\Plugin\ContentType;

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

    public function authenticate(): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(
            new Authentication(
                new AuthProvider($this->clientId, $this->secret)
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
