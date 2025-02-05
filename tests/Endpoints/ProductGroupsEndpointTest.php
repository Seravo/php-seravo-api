<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use RuntimeException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Public\Response\Product;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroup;

final class ProductGroupsEndpointTest extends BaseEndpointTestCase
{
    public function testGetProductGroups(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $this->testCollection(ProductGroup::class, $client->public->productGroups()->get(), $data);

        $this->expectException(RuntimeException::class);
        $client->public->productGroups()->get();
    }

    public function testGetProductGroup(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $name = 'domains';
        $this->testGetObject(ProductGroup::class, $client->public->productGroups()->getByName($name), $data);

        $this->expectException(RuntimeException::class);
        $client->public->productGroups()->getByName($name);
    }

    public function testGetProductGroupsProducts(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $name = 'domains';
        $this->testCollection(Product::class, $client->public->productGroups()->getProducts($name), $data);

        $this->expectException(RuntimeException::class);
        $client->public->productGroups()->getByName($name);
    }
}
