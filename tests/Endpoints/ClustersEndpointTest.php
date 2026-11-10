<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Swd\Response\ClusterCountry;
use Seravo\SeravoApi\Exceptions\BadRequestException;

class ClustersEndpointTest extends BaseEndpointTestCase
{
    public function testGetClusters(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $this->testCollection(
            ClusterCountry::class,
            $client->swd->clusters()->getCountries(),
            array_map(fn (string $country) => ['country' => $country], $data),
            'country'
        );

        $this->expectException(BadRequestException::class);
        $client->swd->clusters()->getCountries();
    }
}
