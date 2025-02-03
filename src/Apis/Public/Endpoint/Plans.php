<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Apis\Public\Response\Plan;
use Seravo\SeravoApi\Apis\Public\Response\PlanCollection;
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
     * @return PlanCollection
     */
    public function get(): PlanCollection
    {
        return $this->api->get(uri: $this->uri, responseClass: PlanCollection::class);
    }

    /**
     * Return a single Plan
     * @see API Reference: https://api.seravo.com/public/docs#/Plans/get_one_public_plans__id__get
     * @param string $id - UUID
     * @return Plan
     */
    public function getById(string $id): Plan
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: Plan::class);
    }
}
