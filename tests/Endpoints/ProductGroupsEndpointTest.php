<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Endpoint\ProductGroups;
use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\Tests\SeravoApi\Endpoints\BaseEndpointCase;

class ProductGroupsEndpointTest extends BaseEndpointCase
{
    public function testGetProductGroups(): void
    {
        $mockData = $this->loadMockData('product_groups/product_groups.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::ProductGroups,
            HttpMethod::Get,
            self::BASE_URI,
            $mockResponse
        );

        $productGroups = new ProductGroups($apiMock);
        $response = $productGroups->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetProductGroupByName(): void
    {
        $mockData = $this->loadMockData('product_groups/product_group.json');
        $mockResponse = json_decode($mockData, true);
        $name = 'domains';

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::ProductGroups,
            HttpMethod::Get,
            self::BASE_URI . $name,
            $mockResponse
        );

        $productGroups = new ProductGroups($apiMock);
        $response = $productGroups->getByName($name);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetProductGroupsProductsByName(): void
    {
        $mockData = $this->loadMockData('product_groups/product_groups_products.json');
        $mockResponse = json_decode($mockData, true);
        $name = 'domains';

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::ProductGroups,
            HttpMethod::Get,
            self::BASE_URI . $name . '/products/',
            $mockResponse
        );

        $productGroups = new ProductGroups($apiMock);
        $response = $productGroups->getProducts($name);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
