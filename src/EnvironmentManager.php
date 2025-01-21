<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Seravo\SeravoApi\Enums\ApiEnvironment;
use Seravo\SeravoApi\Exception\SeravoApiException;

class EnvironmentManager
{
    private ApiEnvironment $environment;

    /**
     *
     * @var array<string, string>
     */
    private array $apiUrl = [
        ApiEnvironment::Production->value => 'https://api.seravo.com',
        ApiEnvironment::Staging->value => 'https://api.seravo.co',
        ApiEnvironment::Testing->value => 'https://api.seravo.dev'
    ];

    /**
     *
     * @var array<string, string>
     */
    private array $idpUrl = [
        ApiEnvironment::Production->value => 'https://id.seravo.com/realms/Seravo',
        ApiEnvironment::Staging->value => 'https://id.seravo.co/realms/Seravo',
        ApiEnvironment::Testing->value => 'https://id.seravo.dev/realms/Seravo'
    ];

    public function __construct(private ?string $env = null)
    {
        $this->setEnvironment();
    }

    public function setEnvironment(): void
    {
        if (is_null($this->env)) {
            // Default to production if no environment is set either via constructor or env variable
            $this->env = @$_ENV['SERAVO_ENVIRONMENT'] ?: ApiEnvironment::Production->value;
        }

        if (!$this->validateEnvironment($this->env)) {
            throw SeravoApiException::invalidEnvironment($this->env);
        }

        $this->environment = \constant(sprintf('%s::%s', ApiEnvironment::class, ucfirst($this->env)));
    }

    public function getEnvironment(): ApiEnvironment
    {
        return $this->environment;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl[$this->environment->value];
    }

    public function getIdpUrl(): string
    {
        return $this->idpUrl[$this->environment->value];
    }

    private function validateEnvironment(?string $environment): bool
    {
        return isset($environment) && $environment !== null && in_array($environment, ApiEnvironment::asArray());
    }
}
