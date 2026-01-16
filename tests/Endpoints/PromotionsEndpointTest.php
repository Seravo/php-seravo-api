<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;
use Seravo\SeravoApi\Exceptions\BadRequestException;

class PromotionsEndpointTest extends BaseEndpointTestCase
{
    public function testGetPromotions(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $this->testCollection(PromotionCode::class, $client->order->promotions()->get(), $data['results']);

        $this->expectException(BadRequestException::class);
        $client->order->promotions()->get();
    }

    public function testGetPromotion(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(PromotionCode::class, $client->order->promotions()->getById($id), $data);

        $this->expectException(BadRequestException::class);
        $client->order->promotions()->getById($id);
    }
}
