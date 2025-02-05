<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use RuntimeException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Order\Response\Affiliate;

final class AffiliatesEndpointTest extends BaseEndpointTestCase
{
    public function testGetAffiliates(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $this->testCollection(Affiliate::class, $client->order->affiliates()->get(), $data);

        $this->expectException(RuntimeException::class);
        $client->order->affiliates()->get();
    }

    public function testGetAffiliate(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(Affiliate::class, $client->order->affiliates()->getById($id), $data);

        $this->expectException(RuntimeException::class);
        $client->order->affiliates()->getById($id);
    }
}
