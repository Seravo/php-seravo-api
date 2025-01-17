<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Endpoint\Prices;
use Seravo\SeravoApi\Apis\Public\Request\Price\CreatePriceRequest;

class PricesEndpointTest extends BaseEndpointCase
{
    public function testGetPriceById(): void
    {
        $mockData = $this->loadMockData('prices/price.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::Prices,
            HttpMethod::Get,
            self::BASE_URI . $id,
            $mockResponse
        );

        $prices = new Prices($apiMock);
        $response = $prices->getById($id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testCreatePrice(): void
    {
        $mockData = $this->loadMockData('prices/price.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::Prices,
            HttpMethod::Post,
            self::BASE_URI,
            $mockResponse
        );

        $request = new CreatePriceRequest(
            interval: 1,
            products: ['test-product-1', 'test-product2'],
            plan: 'test-plan-id'
        );

        $prices = new Prices($apiMock);
        $response = $prices->create($request);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
