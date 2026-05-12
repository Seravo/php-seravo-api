<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\Enums\SortDirection;

class ProductsEndpointUriTest extends TestCase
{
    public function testGetProductsUriQuery(): void
    {
        $history = [];
        $historyMiddleware = Middleware::history($history);

        $mock = new \GuzzleHttp\Handler\MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor('{"results":[]}')),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($historyMiddleware);

        $client = new \Seravo\SeravoApi\SeravoAPI(
            'test1234',
            'test1234',
            null,
            new \Seravo\SeravoApi\HttpClient\Builder(
                new \GuzzleHttp\Client(['handler' => $handlerStack])
            )
        );

        // Test with all parameters
        $page = 2;
        $limit = 10;
        $name = 'example';
        $type = 'PURCHASE';
        $product_type = 'domain';
        $group_id = 'group123';
        $sort = ['name' => SortDirection::Desc, 'price' => SortDirection::Asc];
        $client->public->products()->get($page, $limit, $name, $type, $product_type, $group_id, $sort);

        $this->assertNotEmpty($history, 'No request was recorded');
        $request = $history[0]['request'];
        $uri = (string)$request->getUri();

        $this->assertStringContainsString('page=2', $uri);
        $this->assertStringContainsString('limit=10', $uri);
        $this->assertStringContainsString('name=example', $uri);
        $this->assertStringContainsString('type=PURCHASE', $uri);
        $this->assertStringContainsString('product_type=domain', $uri);
        $this->assertStringContainsString('group_id=group123', $uri);
        $this->assertStringContainsString('sort=name%3Adesc', $uri);
        $this->assertStringContainsString('sort=price%3Aasc', $uri);
    }
}
