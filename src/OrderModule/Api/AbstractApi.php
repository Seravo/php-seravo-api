<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Api;

use Psr\Http\Message\ResponseInterface;
use Seravo\SeravoApi\OrderModule\Client;
use Seravo\SeravoApi\OrderModule\Request\AbstractRequest;
use GuzzleHttp\Exception\RequestException;
use Seravo\SeravoApi\OrderModule\Exception\ApiException;
use Seravo\SeravoApi\OrderModule\HttpClient\Formatter\ResponseFormatter;

abstract class AbstractApi
{

    public function __construct(
        protected readonly Client $client
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    protected function request(string $endpoint, AbstractRequest $request): array
    {
        try {
            $response = $this->client->getHttpClient()->request($request->getMethod(), $endpoint, $request->toArray());
        } catch (RequestException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }

        // Parse response to array
        return ResponseFormatter::format($response);
    }
}
