<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Seravo\SeravoApi\EnvironmentManager;
use Seravo\SeravoApi\Enums\ApiEnvironment;
use Seravo\SeravoApi\Exceptions\SeravoApiException;

final class EnvironmentManagerTest extends TestCase
{
    public function testClassCanBeInstantiateWithNoEnvironmentSet(): void
    {
        $environmentManager = new EnvironmentManager();
        $this->assertInstanceOf(EnvironmentManager::class, $environmentManager);
        $this->assertEquals('production', $environmentManager->getEnvironment()->value);
    }

    /**
    * @return string[][]
    */
    public static function environmentProvider(): array
    {
        return [
            ApiEnvironment::Production->value => [
                'env' => ApiEnvironment::Production->value,
                'apiUrl' => 'https://api.seravo.com',
                'idpUrl' => 'https://id.seravo.com/realms/Seravo'
            ],
            ApiEnvironment::Staging->value => [
                'env' => ApiEnvironment::Staging->value,
                'apiUrl' => 'https://api.seravo.co',
                'idpUrl' => 'https://id.seravo.co/realms/Seravo'
            ],
            ApiEnvironment::Testing->value => [
                'env' => ApiEnvironment::Testing->value,
                'apiUrl' => 'https://api.seravo.dev',
                'idpUrl' => 'https://id.seravo.dev/realms/Seravo'
            ]
        ];
    }

    #[DataProvider('environmentProvider')]
    public function testClassCanBeInstantiatedWithAnEnvironmentSet(string $env, string $apiUrl, string $idpUrl): void
    {
        $environmentManager = new EnvironmentManager($env);
        $this->assertInstanceOf(EnvironmentManager::class, $environmentManager);
        $this->assertEquals($environmentManager->getEnvironment()->value, $env);
        $this->assertEquals($environmentManager->getApiUrl(), $apiUrl);
        $this->assertEquals($environmentManager->getIdpUrl(), $idpUrl);
    }

    #[DataProvider('environmentProvider')]
    public function testGetEnvironmentReturnsTheCorrectEnvironment(string $env, string $apiUrl, string $idpUrl): void
    {
        $environmentManager = new EnvironmentManager($env);
        $this->assertEquals($env, $environmentManager->getEnvironment()->value);
    }

    #[DataProvider('environmentProvider')]
    public function testGetIdpUrlReturnsTheCorrectIdpUrl(string $env, string $apiUrl, string $idpUrl): void
    {
        $environmentManager = new EnvironmentManager($env);
        $this->assertEquals($idpUrl, $environmentManager->getIdpUrl());
    }

    #[DataProvider('environmentProvider')]
    public function testGetApiUrlReturnsTheCorrectApiUrl(string $env, string $apiUrl, string $idpUrl): void
    {
        $environmentManager = new EnvironmentManager($env);
        $this->assertEquals($apiUrl, $environmentManager->getApiUrl());
    }

    public function testEnvironmentManagerThrowsAnExceptionIfAnInvalidEnvironmentIsSet(): void
    {
        $this->expectException(SeravoApiException::class);
        new EnvironmentManager('invalid-environment');
    }
}
