<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Apis\Order\Endpoint\Affiliates;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\Tests\SeravoApi\Endpoints\BaseEndpointCase;

class AffiliatesEndpointTest extends BaseEndpointCase
{
    public function testGetAffiliates(): void
    {
        $mockData = $this->loadMockData('affiliates/affiliates.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Affiliates,
            HttpMethod::Get,
            self::BASE_URI,
            $mockResponse
        );

        $affiliates = new Affiliates($apiMock);
        $response = $affiliates->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetAffliateById(): void
    {
        $mockData = $this->loadMockData('affiliates/affiliate.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Affiliates,
            HttpMethod::Get,
            self::BASE_URI . $id,
            $mockResponse
        );

        $affiliates = new Affiliates($apiMock);
        $response = $affiliates->getById($id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
