<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

abstract class BaseEndpointCase extends TestCase
{
    protected const BASE_URI = 'https://api.seravo.dev';

    protected function loadMockData(string $filename): string
    {
        $filePath = __DIR__ . '/../MockData/' . $filename;
        if (!file_exists($filePath)) {
            throw new \RuntimeException("Mock data file not found: $filePath");
        }

        $data = file_get_contents($filePath);
        if ($data === false) {
            throw new \RuntimeException("Failed to read mock data file: $filePath");
        }

        return $data;
    }

    /**
     * @param array<string, mixed> $response
     * @param class-string $apiClass
     */
    protected function createApiMock(string $apiClass, ApiEndpoint $endpoint, HttpMethod $method, string $uri, array $response): object
    {
        $apiMock = $this->createMock($apiClass);
        $apiMock->expects($this->once())
            ->method('setUri')
            ->with($endpoint)
            ->willReturn(self::BASE_URI);

        $apiMock->expects($this->once())
            ->method('request')
            ->with($method, $uri)
            ->willReturn($response);

        return $apiMock;
    }
}
