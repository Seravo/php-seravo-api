<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Plans
{
    private string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Plans);
    }

    /**
     * Return Plans
     * @see API Reference: https://api.seravo.com/public/docs#/Plans/get_many_public_plans__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->api->request(method: HttpMethod::Get, uri: $this->uri);
    }

    /**
     * Return a single Plan
     * @see API Reference: https://api.seravo.com/public/docs#/Plans/get_one_public_plans__id__get
     *
     * @param string $id - Uuid
     * @return array<mixed, mixed>
     */
    public function getById(string $id): array
    {
        return $this->api->request(method: HttpMethod::Get, uri: $this->uri . $id);
    }
}
