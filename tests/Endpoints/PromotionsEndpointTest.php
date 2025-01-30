<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use RuntimeException;
use GuzzleHttp\Psr7\Response;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;

class PromotionsEndpointTest extends BaseEndpointTestCase
{
    public function testGetPromotions(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($data)),
            new Response(400, [], json_encode(['error' => 'Bad Request'])),
        ]);

        $this->testArrayOfObjects(PromotionCode::class, $client->order->promotions()->get(), $data);

        $this->expectException(RuntimeException::class);
        $client->order->promotions()->get();
    }

    public function testGetPromotion(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($data)),
            new Response(400, [], json_encode(['error' => 'Bad Request'])),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(PromotionCode::class, $client->order->promotions()->getById($id), $data);

        $this->expectException(RuntimeException::class);
        $client->order->promotions()->getById($id);
    }
}
