<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\SortDirection;
use Seravo\SeravoApi\Apis\Public\Response\ProductCollection;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroup;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroupCollection;

class ProductGroups
{
    private string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::ProductGroups);
    }

    /**
     * Return all ProductGroups
     * @see API Reference: https://api.seravo.com/public/docs#/Product%20groups/get_many_public_product_groups__get
     *
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param string|null         $name    Optional name filter
     * @param array<string, SortDirection>  $sort    Optional sort fields
     * @return ProductGroupCollection
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        ?string $name = null,
        array $sort = []
    ): ProductGroupCollection {

        $query = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($name !== null) {
            $query['name'] = $name;
        }

        $uri = $this->api->buildUriWithParams(baseUri: $this->uri, query: $query, sort: $sort);
        return $this->api->get(uri: $uri, responseClass: ProductGroupCollection::class);
    }

    /**
     * Return a single ProductGroup
     * @see API Reference: https://api.seravo.com/public/docs#/Product%20groups/get_one_public_product_groups__name__get
     * @param string $name
     * @return ProductGroup
     */
    public function getByName(string $name): ProductGroup
    {
        return $this->api->get(uri: $this->uri . $name, responseClass: ProductGroup::class);
    }

    /**
     * Get product group's products
     * @see API Reference:
     * https://api.seravo.com/public/docs#/Product%20groups/get_nested_public_product_groups__name__products__get
     * @param string $name
     * @return ProductCollection
     */
    public function getProducts(string $name): ProductCollection
    {
        return $this->api->get(uri: $this->uri . $name . '/products/', responseClass: ProductCollection::class);
    }
}
