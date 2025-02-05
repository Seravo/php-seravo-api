<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Seravo\SeravoApi\Enums\ApiEnvironment;
use Seravo\SeravoApi\Exception\SeravoApiException;

class EnvironmentManager
{
    private ApiEnvironment $environment;

    private string $apiUrl;

    private string $idpUrl;

    public function __construct(?string $environment = null)
    {
        $this->setEnvironment($environment);
        $this->setApiUrl();
        $this->setIdpUrl();
    }

    public function setEnvironment(?string $environment): void
    {
        if (is_null($environment)) {
            // Default to production if no environment is set either via constructor or env variable
            $environment = @$_ENV['SERAVO_ENVIRONMENT'] ?: ApiEnvironment::Production->value;
        }

        if (!$this->validateEnvironment($environment)) {
            throw SeravoApiException::invalidEnvironment($environment);
        }

        $this->environment = \constant(sprintf('%s::%s', ApiEnvironment::class, ucfirst((string) $environment)));
    }

    public function getEnvironment(): ApiEnvironment
    {
        return $this->environment;
    }

    private function validateEnvironment(?string $environment): bool
    {
        return isset($environment) && in_array($environment, ApiEnvironment::asArray());
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function setApiUrl(): void
    {
        $this->apiUrl = match ($this->environment) {
            ApiEnvironment::Production => 'https://api.seravo.com',
            ApiEnvironment::Staging => 'https://api.seravo.co',
            ApiEnvironment::Testing => 'https://api.seravo.dev'
        };
    }

    public function getIdpUrl(): string
    {
        return $this->idpUrl;
    }

    public function setIdpUrl(): void
    {
        $this->idpUrl = match ($this->environment) {
            ApiEnvironment::Production => 'https://id.seravo.com/realms/Seravo',
            ApiEnvironment::Staging => 'https://id.seravo.co/realms/Seravo',
            ApiEnvironment::Testing => 'https://id.seravo.dev/realms/Seravo'
        };
    }
}
