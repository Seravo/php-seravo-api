<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Api;

use Psr\Http\Message\ResponseInterface;
use Seravo\SeravoApi\OrderModule\Client;
use Seravo\SeravoApi\OrderModule\Request\AbstractRequest;
use GuzzleHttp\Exception\RequestException;
use Seravo\SeravoApi\OrderModule\Exception\ApiException;

abstract class AbstractApi
{

    public function __construct(
        protected readonly Client $client
    ) {
    }

    protected function request(string $endpoint, AbstractRequest $request): ResponseInterface
    {
        try {
            $response = $this->client->getHttpClient()->request($request->getMethod(), $endpoint, $request->getOptions());
            return $response;
        } catch (RequestException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }

        // TODO: Parse response to array
    }
}
