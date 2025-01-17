<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Apis\Order\Endpoint\Promotions;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\Tests\SeravoApi\Endpoints\BaseEndpointCase;

class PromotionsEndpointTest extends BaseEndpointCase
{
    public function testGetPromotions(): void
    {
        $mockData = $this->loadMockData('promotions/promotions.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Promotions,
            HttpMethod::Get,
            self::BASE_URI,
            $mockResponse
        );

        $promotions = new Promotions($apiMock);
        $response = $promotions->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetPromotionById(): void
    {
        $mockData = $this->loadMockData('promotions/promotion.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Promotions,
            HttpMethod::Get,
            self::BASE_URI . $id,
            $mockResponse
        );

        $promotions = new Promotions($apiMock);
        $response = $promotions->getById($id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
