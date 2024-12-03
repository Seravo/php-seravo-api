<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\SeravoAPI;

class PricesEndpointTest extends TestCase
{
    /**
     *
     * @param array<object> $requests
     */
    public function createClientHandler(array $requests, ?MockHandler &$mock = null): SeravoAPI
    {
        $mock = new MockHandler($requests);

        return new SeravoAPI(
            baseUrl: 'https://example.com',
            clientId: 'username',
            secret: 'password',
            httpClientBuilder: new Builder(new Client(['handler' => Handlerstack::create($mock)]))
        );
    }

    public function testGetPrice(): void
    {
        $data = file_get_contents(__DIR__ . '/../MockData/price.json');

        $api = $this->createClientHandler([new Response(200, ['Content-Type' => 'application/json'], $data)]);

        $response = $api->public->prices()->get();

        $this->assertIsArray($response);
        $this->assertJsonStringEqualsJsonString($data, json_encode($response));
    }

    public function testGetPrices(): void
    {
        $data = file_get_contents(__DIR__ . '/../MockData/prices.json');

        $api = $this->createClientHandler([new Response(200, ['Content-Type' => 'application/json'], $data)]);

        $response = $api->public->prices()->get();

        $this->assertIsArray($response);
        $this->assertJsonStringEqualsJsonString($data, json_encode($response));
    }
}
