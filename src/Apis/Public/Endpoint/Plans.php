<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Apis\Public\Response\Plan;
use Seravo\SeravoApi\Apis\Public\Response\PlanCollection;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\SortDirection;

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
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param bool                $all     Optional flag to include all plans
     * @param string|null         $promotion Optional promotion filter
     * @param array<string, SortDirection>  $sort    Optional sort fields
     * @return PlanCollection
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        bool $all = false,
        ?string $promotion = null,
        array $sort = []
    ): PlanCollection {
        $query = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($promotion !== null) {
            $query['promotion'] = $promotion;
        }

        if ($all) {
            $query['all'] = true;
        }

        $uri = $this->api->buildUriWithParams(baseUri: $this->uri, query: $query, sort: $sort);
        return $this->api->get(uri: $uri, responseClass: PlanCollection::class);
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
