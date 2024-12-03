<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\Public\Request\CreatePriceRequest;
use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Prices
{
    private string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Prices);
    }

    /**
     * Create a new Price
     * @see API Reference: https://api.seravo.com/public/docs#/Prices/create_public_prices__post
     *
     * @return array<string, mixed>
     */
    public function create(CreatePriceRequest $request): array
    {
        return $this->api->request(method: HttpMethod::Post, uri: $this->uri, body: $request);
    }

    /**
     * Return a single Price
     * @see API Reference: https://api.seravo.dev/public/docs#/Prices/get_one_public_prices__id__get
     *
     * @param string $id - Uuid
     * @return array<mixed, mixed>
     */
    public function getById(string $id): array
    {
        return $this->api->request(method: HttpMethod::Get, uri: $this->uri . $id);
    }
}
