<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use RuntimeException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Public\Response\Price;
use Seravo\SeravoApi\Apis\Public\Request\Price\CreatePriceRequest;

class PricesEndpointTest extends BaseEndpointTestCase
{
    public function testCreatePrice(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);


        $request = new CreatePriceRequest(
            interval: 1,
            products: ['test-product-1', 'test-product2'],
            plan: 'test-plan-id'
        );

        $this->testGetObject(Price::class, $client->public->prices()->create($request), $data);

        $this->expectException(RuntimeException::class);
        $client->public->prices()->create($request);
    }

    public function testGetPrice(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(Price::class, $client->public->prices()->getById($id), $data);

        $this->expectException(RuntimeException::class);
        $client->public->prices()->getById($id);
    }
}
