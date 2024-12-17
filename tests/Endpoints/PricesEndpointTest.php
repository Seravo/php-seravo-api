<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Endpoint\Prices;

class PricesEndpointTest extends BaseEndpointCase
{
    public function testGetPrice(): void
    {
        $mockData = $this->loadMockData('prices/price.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(ApiEndpoint::Prices, HttpMethod::Get, self::BASE_URI, $mockResponse);

        $prices = new Prices($apiMock);
        $response = $prices->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetPrices(): void
    {
        $mockData = $this->loadMockData('prices/prices.json');
        $mockResponse = json_decode($mockData, true);
        $priceId = '12345';

        $apiMock = $this->createApiMock(ApiEndpoint::Prices, HttpMethod::Get, self::BASE_URI . $priceId, $mockResponse);

        $prices = new Prices($apiMock);
        $response = $prices->getById($priceId);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
