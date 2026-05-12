<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\SortDirection;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCodeCollection;

class Promotions
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Promotions);
    }

    /**
     * Return PromotionCodes
     * @see API Reference: https://api.seravo.com/order/docs#/Promotions/get_many_order_promotions__get
     *
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param string|null         $name    Optional name filter
     * @param array<string, SortDirection>  $sort    Optional sort fields
     * @return PromotionCodeCollection
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        ?string $name = null,
        array $sort = []
    ): PromotionCodeCollection {
        $query = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($name !== null) {
            $query['name'] = $name;
        }

        $uri = $this->api->buildUriWithParams(baseUri: $this->uri, query: $query, sort: $sort);
        return $this->api->get(uri: $uri, responseClass: PromotionCodeCollection::class);
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
