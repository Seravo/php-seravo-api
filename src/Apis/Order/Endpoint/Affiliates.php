<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Order\Response\Affiliate;
use Seravo\SeravoApi\Apis\Order\Response\AffiliateCollection;

class Affiliates
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Affiliates);
    }

    /**
     * Return all Affiliates
     * @see API Reference: https://api.seravo.com/order/docs#/Affiliates/get_many_order_affiliates__get
     * @return AffiliateCollection
     */
    public function get(): AffiliateCollection
    {
        $response = $this->api->get(uri: $this->uri, responseClass: Affiliate::class);
        return new AffiliateCollection(...$response);
    }

    /**
     * Return a single Affiliate
     * @see API Reference: https://api.seravo.com/order/docs#/Affiliates/get_one_order_affiliates__id__get
     * @param string $id - UUID
     * @return Affiliate
     */
    public function getById(string $id): Affiliate
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: Affiliate::class);
    }
}
