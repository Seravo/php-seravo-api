<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCodeCollection;

class Promotions
{
    private readonly string $uri;

    public function __construct(
        private readonly OrderApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Promotions);
    }

    /**
     * Return all PromotionCodes
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_many_order_promotions__get
     */
    public function get(): PromotionCodeCollection
    {
        return $this->api->get(uri: $this->uri, responseClass: PromotionCodeCollection::class);
    }

    /**
     * Return a single PromotionCode
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_one_order_promotions__identifier__get
     * @param string $id - UUID
     */
    public function getById(string $id): PromotionCode
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: PromotionCode::class);
    }
}
