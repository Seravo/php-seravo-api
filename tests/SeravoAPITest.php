<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi;

use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\HttpClient\Builder;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Seravo\SeravoApi\HttpClient\Plugin\ContentType;
use Seravo\SeravoApi\HttpClient\Plugin\ExceptionHandler;

class SeravoAPITest extends TestCase
{
    private const BASE_URL = 'https://example.com';
    private const CLIENT_ID = 'username';
    private const SECRET = 'password';

    public function testClassCanBeInstantiatedWithDefaultHttpClientBuilder(): void
    {
        $api = new SeravoAPI(self::BASE_URL, self::CLIENT_ID, self::SECRET);

        $this->assertInstanceOf(OrderApi::class, $api->order);
        $this->assertInstanceOf(PublicApi::class, $api->public);
        $this->assertSame(self::BASE_URL, $api->baseUrl);
        $this->assertSame(self::CLIENT_ID, $api->clientId);
        $this->assertSame(self::SECRET, $api->secret);
    }

    public function testClassCanBeInstantiatedWithHttpClientBuilderDefinedAsAnArgumentAndDefaultHttpPlugins(): void
    {
        $builder = $this->createMock(Builder::class);
        $expectedPlugins = [
            HeaderDefaultsPlugin::class,
            ContentType::class,
            ExceptionHandler::class,
        ];

        $builder->expects($this->exactly(count($expectedPlugins)))
            ->method('addPlugin')
            ->willReturnCallback(function ($plugin) use (&$expectedPlugins) {
                $expectedPlugin = array_shift($expectedPlugins);
                $this->assertInstanceOf($expectedPlugin, $plugin);
            });

        $api = new SeravoAPI(self::BASE_URL, self::CLIENT_ID, self::SECRET, $builder);

        $this->assertInstanceOf(SeravoApi::class, $api);
    }
}
