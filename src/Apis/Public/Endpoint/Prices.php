<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

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
     * Return Prices
     * @see API Reference: https://api.seravo.dev/public/docs#/Prices/get_many_public_prices__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->api->request(method: HttpMethod::Get, uri: $this->uri);
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
