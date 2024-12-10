<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Products
{
    private string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Products);
    }

    /**
     * Return all Products
     * @see API Reference: https://api.seravo.com/public/docs#/Products/get_many_public_products__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->api->request(method: HttpMethod::Get, uri: $this->uri);
    }

    /**
     * Return a single Product
     * @see API Reference: https://api.seravo.com/public/docs#/Products/get_one_public_products__id__get
     *
     * @param string $id - Uuid
     * @return array<mixed, mixed>
     */
    public function getById(string $id): array
    {
        return $this->api->request(method: HttpMethod::Get, uri: $this->uri . $id);
    }
}
