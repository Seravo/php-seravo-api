<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

use Seravo\SeravoApi\Apis\OrderAPI;
use Seravo\SeravoApi\Apis\PublicAPI;

use Seravo\SeravoApi\AuthProvider;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\HttpClient\Plugin\Authentication;
use Seravo\SeravoApi\HttpClient\Plugin\ContentType;

final class SeravoAPI
{
    public OrderAPI $order;

    public PublicAPI $public;

    public function __construct(
        public readonly string $baseUrl,
        public readonly string $clientId,
        public readonly string $secret,
        private ?Builder $httpClientBuilder = null
    ) {
        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
        $this->setDefaultHttpPlugins();

        $this->order = new OrderAPI($this->baseUrl, $this->getHttpClientBuilder());
        $this->public = new PublicAPI($this->baseUrl, $this->getHttpClientBuilder());
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

    public function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    private function setDefaultHttpPlugins(): void
    {
        $builder = $this->httpClientBuilder;

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'accept' => 'application/json'
        ]));

        $builder->addPlugin(new ContentType());
    }
}
