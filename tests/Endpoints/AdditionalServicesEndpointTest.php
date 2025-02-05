<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use RuntimeException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Order\Response\AdditionalService;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\EditAdditionalServiceRequest;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\CreateAdditionalServiceRequest;

final class AdditionalServicesEndpointTest extends BaseEndpointTestCase
{
    public function testGetAdditionalService(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(AdditionalService::class, $client->order->additionalServices()->getById($id), $data);

        $this->expectException(RuntimeException::class);
        $client->order->additionalServices()->getById($id);
    }

    public function testCreateAdditionalService(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(201, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $request = new CreateAdditionalServiceRequest(
            transferKeys: ['test-key'],
            dnsZone: 'testzonedataedited'
        );

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(
            AdditionalService::class,
            $client->order->additionalServices()->create($request, $id),
            $data
        );

        $this->expectException(RuntimeException::class);
        $client->order->additionalServices()->create($request, $id);
    }

    public function testEditAdditionalService(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(201, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $request = new EditAdditionalServiceRequest(
            transferKeys: ['test-key'],
            dnsZone: 'testzonedataedited'
        );

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(
            AdditionalService::class,
            $client->order->additionalServices()->edit($request, $id),
            $data
        );

        $this->expectException(RuntimeException::class);
        $client->order->additionalServices()->edit($request, $id);
    }
}
