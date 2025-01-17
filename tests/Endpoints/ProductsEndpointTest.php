<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Endpoint\Products;

class ProductsEndpointTest extends BaseEndpointCase
{
    public function testGetProducts(): void
    {
        $mockData = $this->loadMockData('products/products.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::Products,
            HttpMethod::Get,
            self::BASE_URI,
            $mockResponse
        );

        $products = new Products($apiMock);
        $response = $products->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetProductById(): void
    {
        $mockData = $this->loadMockData('products/product.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::Products,
            HttpMethod::Get,
            self::BASE_URI . $id,
            $mockResponse
        );

        $products = new Products($apiMock);
        $response = $products->getById($id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
