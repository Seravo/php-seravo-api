<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Promotions
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Promotions);
    }

    /**
     * Return all PromotionCodes
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_many_order_promotions__get
     * @return array<int, PromotionCode>
     */
    public function get(): array
    {
        return $this->api->get(uri: $this->uri, responseClass: PromotionCode::class);
    }

    /**
     * Return a single PromotionCode
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_one_order_promotions__identifier__get
     * @param string $id - UUID
     * @return PromotionCode
     */
    public function getById(string $id): PromotionCode
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: PromotionCode::class);
    }
}
