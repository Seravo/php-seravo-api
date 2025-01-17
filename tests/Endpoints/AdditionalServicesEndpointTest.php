<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Apis\Order\Endpoint\AdditionalServices;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\CreateAdditionalServiceRequest;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\EditAdditionalServiceRequest;
use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\Tests\SeravoApi\Endpoints\BaseEndpointCase;

class AdditionalServicesEndpointTest extends BaseEndpointCase
{
    public function testGetAdditionalServiceById(): void
    {
        $mockData = $this->loadMockData('additional_services/additional_service.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Orders,
            HttpMethod::Get,
            self::BASE_URI . $id . '/services/',
            $mockResponse
        );

        $additionalServices = new AdditionalServices($apiMock);
        $response = $additionalServices->getById($id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testCreateAdditionalService(): void
    {
        $mockData = $this->loadMockData('additional_services/additional_service.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Orders,
            HttpMethod::Put,
            self::BASE_URI . $id . '/services/',
            $mockResponse
        );

        $request = new CreateAdditionalServiceRequest(
            transferKeys: ['test-key'],
            dnsZone: 'test-dns-zone'
        );

        $additionalServices = new AdditionalServices($apiMock);
        $response = $additionalServices->create($request, $id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testEditAdditionalService(): void
    {
        $mockData = $this->loadMockData('additional_services/additional_service.json');
        $mockResponse = json_decode($mockData, true);
        $id = 'test-id';

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Orders,
            HttpMethod::Patch,
            self::BASE_URI . $id . '/services/',
            $mockResponse
        );

        $request = new EditAdditionalServiceRequest(
            transferKeys: ['test-key'],
            dnsZone: 'test-dns-zone'
        );

        $additionalServices = new AdditionalServices($apiMock);
        $response = $additionalServices->edit($request, $id);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
