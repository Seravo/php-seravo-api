<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\SortDirection;
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
     * Return Affiliates
     * @see API Reference: https://api.seravo.com/order/docs#/Affiliates/get_many_order_affiliates__get
     *
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param string|null         $name    Optional name filter
     * @param string|null         $partner_id Optional partner_id filter
     * @param array<string, SortDirection>  $sort    Optional sort fields
     * @return AffiliateCollection
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        ?string $name = null,
        ?string $partner_id = null,
        array $sort = []
    ): AffiliateCollection {
        $query = [
            'page' => $page,
            'limit' => $limit,
        ];
        if ($name !== null) {
            $query['name'] = $name;
        }
        if ($partner_id !== null) {
            $query['partner_id'] = $partner_id;
        }

        $uri = $this->api->buildUriWithParams($this->uri, $query, $sort);
        return $this->api->get(uri: $uri, responseClass: AffiliateCollection::class);
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
