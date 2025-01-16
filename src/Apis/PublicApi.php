<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\Enums\ApiModule;
use Seravo\SeravoApi\Apis\Public\Endpoint\Prices;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\Apis\Public\Endpoint\Products;
use Seravo\SeravoApi\Apis\Public\Endpoint\Plans;
use Seravo\SeravoApi\Apis\Public\Endpoint\ProductGroups;

class PublicApi extends AbstractApi
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder
    ) {
        parent::__construct($this->baseUrl, $this->httpClientBuilder, ApiModule::Public);
    }

    public function prices(): Prices
    {
        return new Prices($this);
    }

    public function products(): Products
    {
        return new Products($this);
    }

    public function plans(): Plans
    {
        return new Plans($this);
    }

    public function productGroups(): ProductGroups
    {
        return new ProductGroups($this);
    }
}
