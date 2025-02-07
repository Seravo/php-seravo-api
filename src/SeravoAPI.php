<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Seravo\SeravoApi\JwtVerifier;
use Seravo\SeravoApi\OpenIdConnectAuthProvider;
use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\HttpClient\Builder;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Predis\ClientInterface as CacheClient;
use Seravo\SeravoApi\HttpClient\Plugin\Authentication;
use Seravo\SeravoApi\HttpClient\Plugin\ContentType;
use Seravo\SeravoApi\HttpClient\Plugin\ExceptionHandler;
use Seravo\SeravoApi\HttpClient\Plugin\TokenVerifier;

final class SeravoAPI
{
    private readonly EnvironmentManager $environmentManager;

    public readonly OrderApi $order;

    public readonly PublicApi $public;

    private Builder $httpClientBuilder;

    private ?CacheClient $cacheClient;

    public function __construct(
        public readonly string $clientId,
        public readonly string $secret,
        public ?string $environment = null,
        ?Builder $httpClientBuilder = null,
        ?CacheClient $cacheClient = null,
    ) {
        $this->environmentManager = new EnvironmentManager($environment);

        $this->cacheClient = $cacheClient ?? null;
        $this->httpClientBuilder = $httpClientBuilder ?? new Builder(cacheClient: $this->cacheClient);
        $this->setDefaultHttpPlugins();

        $this->order = new OrderApi($this->environmentManager->getApiUrl(), $this->httpClientBuilder);
        $this->public = new PublicApi($this->environmentManager->getApiUrl(), $this->httpClientBuilder);
    }

    public static function create(
        string $clientId,
        string $secret,
        ?string $environment = null,
        ?Builder $httpClientBuilder = null,
        ?CacheClient $cacheClient = null,
    ): self {
        return new self($clientId, $secret, $environment, $httpClientBuilder, $cacheClient);
    }

    public function authenticate(): void
    {
        $this->httpClientBuilder->removePlugin(Authentication::class);
        $this->httpClientBuilder->removePlugin(TokenVerifier::class);

        $this->httpClientBuilder->addPlugin(
            new Authentication(
                $authProvider = new OpenIdConnectAuthProvider(
                    clientId: $this->clientId,
                    secret: $this->secret,
                    providerUrl: $this->environmentManager->getIdpUrl()
                )
            )
        );

        $this->httpClientBuilder->addPlugin(new TokenVerifier(
            new JwtVerifier($this->environmentManager),
            $authProvider
        ));
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
