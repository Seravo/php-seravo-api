<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Affiliates
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $orderApi
    ) {
        $this->uri = $this->orderApi->setUri(ApiEndpoint::Affiliates);
    }

    /**
     * Return all Affiliates
     * @see API Reference: https://api.seravo.com/order/docs#/Affiliates/get_many_order_affiliates__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->orderApi->request(method: HttpMethod::Get, uri: $this->uri);
    }

    /**
     * Return a single Affiliate
     * @see API Reference: https://api.seravo.com/order/docs#/Affiliates/get_one_order_affiliates__id__get
     *
     * @param string $id - UUID
     * @return array<mixed, mixed>
     */
    public function getById(string $id): array
    {
        return $this->orderApi->request(method: HttpMethod::Get, uri: $this->uri . $id);
    }
}
