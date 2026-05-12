<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\Enums\SortDirection;

class PlansEndpointUriTest extends TestCase
{
    public function testGetPlansUriQuery(): void
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
        $all = true;
        $promotion = 'promo';
        $sort = ['monitor_interval' => SortDirection::Asc, 'redis_max_mem' => SortDirection::Desc];
        $client->public->plans()->get($page, $limit, $all, $promotion, $sort);

        $this->assertNotEmpty($history, 'No request was recorded');
        $request = $history[0]['request'];
        $uri = (string)$request->getUri();

        $this->assertStringContainsString('page=2', $uri);
        $this->assertStringContainsString('limit=10', $uri);
        $this->assertStringContainsString('all=1', $uri);
        $this->assertStringContainsString('promotion=promo', $uri);
        $this->assertStringContainsString('sort=monitor_interval%3Aasc', $uri);
        $this->assertStringContainsString('sort=redis_max_mem%3Adesc', $uri);
    }
}
