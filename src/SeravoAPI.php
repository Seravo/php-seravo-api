<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Seravo\SeravoApi\OpenIdConnectAuthProvider;
use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\HttpClient\Builder;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Seravo\SeravoApi\HttpClient\Plugin\Authentication;
use Seravo\SeravoApi\HttpClient\Plugin\ContentType;
use Seravo\SeravoApi\HttpClient\Plugin\ExceptionHandler;

final class SeravoAPI
{
    private readonly EnvironmentManager $environmentManager;

    public readonly OrderApi $order;

    public readonly PublicApi $public;

    public function __construct(
        public readonly string $clientId,
        public readonly string $secret,
        public ?string $environment = null,
        private ?Builder $httpClientBuilder = null
    ) {
        $this->environmentManager = new EnvironmentManager($environment);

        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
        $this->setDefaultHttpPlugins();

        $this->order = new OrderApi($this->environmentManager->getApiUrl(), $this->httpClientBuilder);
        $this->public = new PublicApi($this->environmentManager->getApiUrl(), $this->httpClientBuilder);
    }

    public function authenticate(): void
    {
        $this->httpClientBuilder->removePlugin(Authentication::class);
        $this->httpClientBuilder->addPlugin(
            new Authentication(
                new OpenIdConnectAuthProvider(
                    clientId: $this->clientId,
                    secret: $this->secret,
                    providerUrl: $this->environmentManager->getIdpUrl(),
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
