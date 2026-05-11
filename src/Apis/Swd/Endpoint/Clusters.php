<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Endpoint;

use Seravo\SeravoApi\Apis\Swd\Response\ClusterCollection;
use Seravo\SeravoApi\Apis\SwdApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Clusters
{
    private string $uri;

    public function __construct(
        private readonly SwdApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Clusters);
    }

    /**
     * Return all Clusters.
     *
     * Mirrors the swd /clusters/ GET endpoint and supports the same
     * pagination and filter query parameters.
     *
     * @see API Reference: https://api.seravo.com/swd/docs#/Clusters/get_many_swd_clusters__get
     *
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param string|null         $name    Optional name filter
     * @param string|null         $country Optional country filter
     * @param array<int, string>  $sort    Optional sort fields
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        ?string $name = null,
        ?string $country = null,
        array $sort = []
    ): ClusterCollection {
        $query = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($name !== null) {
            $query['name'] = $name;
        }

        if ($country !== null) {
            $query['country'] = $country;
        }

        if ($sort !== []) {
            $query['sort'] = $sort;
        }

        $uri = $this->uri . '?' . http_build_query($query);

        return $this->api->get(uri: $uri, responseClass: ClusterCollection::class);
    }
}
