<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Apis\Public\Response\Product;
use Seravo\SeravoApi\Apis\Public\Response\ProductCollection;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\SortDirection;

class Products
{
    private string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Products);
    }

    /**
     * Return all Products
     * @see API Reference: https://api.seravo.com/public/docs#/Products/get_many_public_products__get
     *
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param string|null         $name    Optional name filter
     * @param string|null         $type    Optional type filter
     * @param string|null         $product_type    Optional product type filter
     * @param string|null         $group_id    Optional group ID filter
     * @param array<string, SortDirection>  $sort    Optional sort fields
     * @return ProductCollection
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        ?string $name = null,
        ?string $type = null,
        ?string $product_type = null,
        ?string $group_id = null,
        array $sort = []
    ): ProductCollection {
        $query = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($name !== null) {
            $query['name'] = $name;
        }

        if ($type !== null) {
            $query['type'] = $type;
        }

        if ($product_type !== null) {
            $query['product_type'] = $product_type;
        }

        if ($group_id !== null) {
            $query['group_id'] = $group_id;
        }

        $uri = $this->api->buildUriWithParams(baseUri: $this->uri, query: $query, sort: $sort);
        return $this->api->get(uri: $uri, responseClass: ProductCollection::class);
    }

    /**
     * Return a single Product
     * @see API Reference: https://api.seravo.com/public/docs#/Products/get_one_public_products__id__get
     * @param string $id - UUID
     * @return Product
     */
    public function getById(string $id): Product
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: Product::class);
    }
}
