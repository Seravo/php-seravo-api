<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Promotions
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $orderApi
    ) {
        $this->uri = $this->orderApi->setUri(ApiEndpoint::Promotions);
    }

    /**
     * Return all PromotionCodes
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_many_order_promotions__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->orderApi->request(method: HttpMethod::Get, uri: $this->uri);
    }

    /**
     * Return a single PromotionCode
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_one_order_promotions__identifier__get
     *
     * @param string $id - UUID
     * @return array<mixed, mixed>
     */
    public function getById(string $id): array
    {
        return $this->orderApi->request(method: HttpMethod::Get, uri: $this->uri . $id);
    }
}
