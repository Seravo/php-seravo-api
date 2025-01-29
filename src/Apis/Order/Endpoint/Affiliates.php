<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\Order\Response\Affiliate;
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
     * @return array<int, Affiliate>
     */
    public function get(): array
    {
        return $this->orderApi->request(
            method: HttpMethod::Get,
            uri: $this->uri,
            responseClass: Affiliate::class
        );
    }

    /**
     * Return a single Affiliate
     * @see API Reference: https://api.seravo.com/order/docs#/Affiliates/get_one_order_affiliates__id__get
     * @param string $id - UUID
     * @return Affiliate
     */
    public function getById(string $id): Affiliate
    {
        return $this->orderApi->request(
            method: HttpMethod::Get,
            uri: $this->uri . $id,
            responseClass: Affiliate::class
        );
    }
}
