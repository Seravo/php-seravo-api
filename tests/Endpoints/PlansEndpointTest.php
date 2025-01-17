<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Endpoint\Plans;
use Seravo\SeravoApi\Apis\PublicApi;

class PlansEndpointTest extends BaseEndpointCase
{
    public function testGetPlans(): void
    {
        $mockData = $this->loadMockData('plans/plans.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::Plans,
            HttpMethod::Get,
            self::BASE_URI,
            $mockResponse
        );

        $plans = new Plans($apiMock);
        $response = $plans->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetPlanById(): void
    {
        $mockData = $this->loadMockData('plans/plan.json');
        $mockResponse = json_decode($mockData, true);
        $planId = '12345';

        $apiMock = $this->createApiMock(
            PublicApi::class,
            ApiEndpoint::Plans,
            HttpMethod::Get,
            self::BASE_URI . $planId,
            $mockResponse
        );

        $plans = new Plans($apiMock);
        $response = $plans->getById($planId);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
