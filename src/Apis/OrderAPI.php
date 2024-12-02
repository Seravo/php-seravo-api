<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\HttpClient\Builder;
use Seravo\SeravoApi\Apis\Order\Endpoint\Orders;

class OrderAPI extends BaseAPI
{
    public const ENDPOINT_PREFIX = '/order/';

    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder
    ) {
        parent::__construct($this->baseUrl, $this->httpClientBuilder, self::ENDPOINT_PREFIX);
    }

    public function orders(): Orders
    {
        return new Orders($this);
    }
}
