<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use RuntimeException;
use GuzzleHttp\Psr7\Response;
use Seravo\SeravoApi\Apis\Order\Response\Affiliate;

class AffiliatesEndpointTest extends BaseEndpointTestCase
{
    public function testGetAffiliates(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($data)),
            new Response(400, [], json_encode(['error' => 'Bad Request'])),
        ]);

        $this->testArrayOfObjects(Affiliate::class, $client->order->affiliates()->get(), $data);

        $this->expectException(RuntimeException::class);
        $client->order->affiliates()->get();
    }

    public function testGetAffiliate(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($data)),
            new Response(400, [], json_encode(['error' => 'Bad Request'])),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(Affiliate::class, $client->order->affiliates()->getById($id), $data);

        $this->expectException(RuntimeException::class);
        $client->order->affiliates()->getById($id);
    }
}
