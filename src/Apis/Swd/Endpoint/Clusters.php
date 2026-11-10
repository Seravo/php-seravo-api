<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Endpoint;

use Seravo\SeravoApi\Apis\Swd\Response\ClusterCountryCollection;
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
     * Return supported countries in ISO-3166-1 alpha 2 format
     *
     * @see API Reference: https://api.seravo.dev/swd/docs#/Clusters/get_countries_swd_v1_clusters_countries__get
     */
    public function getCountries(): ClusterCountryCollection
    {
        return $this->api->get(uri: $this->uri . 'countries/', responseClass: ClusterCountryCollection::class);
    }
}
