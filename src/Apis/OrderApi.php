<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\Enums\ApiModule;
use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\Apis\Order\Endpoint\Orders;
use Seravo\SeravoApi\Apis\Order\Endpoint\Promotions;

class OrderApi extends AbstractApi
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder
    ) {
        parent::__construct($this->baseUrl, $this->httpClientBuilder, ApiModule::Order);
    }

    public function orders(): Orders
    {
        return new Orders($this);
    }

    public function promotions(): Promotions
    {
        return new Promotions($this);
    }
}
