<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Seravo\SeravoApi\AuthProvider;
use Seravo\SeravoApi\Apis\OrderAPI;
use Seravo\SeravoApi\Apis\PublicAPI;
use Seravo\SeravoApi\HttpClient\Builder;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Seravo\SeravoApi\HttpClient\Plugin\Authentication;
use Seravo\SeravoApi\HttpClient\Plugin\ContentType;
use Seravo\SeravoApi\HttpClient\Plugin\ExceptionHandler;

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

        $this->order = new OrderAPI($this->baseUrl, $this->httpClientBuilder);
        $this->public = new PublicAPI($this->baseUrl, $this->httpClientBuilder);
    }

    public function authenticate(string $authProviderUrl, string $tokenEndpoint): void
    {
        $this->httpClientBuilder->removePlugin(Authentication::class);
        $this->httpClientBuilder->addPlugin(
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

    private function setDefaultHttpPlugins(): void
    {
        $builder = $this->httpClientBuilder;

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]));

        $builder->addPlugin(new ContentType());
        $builder->addPlugin(new ExceptionHandler());
    }
}
