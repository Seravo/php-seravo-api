<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Endpoint\Products;

class ProductsEndpointTest extends BaseEndpointCase
{
    public function testGetProducts(): void
    {
        $mockData = $this->loadMockData('products/products.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(ApiEndpoint::Products, HttpMethod::Get, self::BASE_URI, $mockResponse);

        $products = new Products($apiMock);
        $response = $products->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetProductById(): void
    {
        $mockData = $this->loadMockData('products/product.json');
        $mockResponse = json_decode($mockData, true);
        $productId = '12345';

        $apiMock = $this->createApiMock(
            ApiEndpoint::Products,
            HttpMethod::Get,
            self::BASE_URI . $productId,
            $mockResponse
        );

        $plans = new Products($apiMock);
        $response = $plans->getById($productId);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
