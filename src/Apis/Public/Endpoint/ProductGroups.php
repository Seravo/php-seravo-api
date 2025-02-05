<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Public\Response\Product;
use Seravo\SeravoApi\Apis\Public\Response\ProductCollection;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroup;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroupCollection;

class ProductGroups
{
    private readonly string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::ProductGroups);
    }

    /**
     * Return all ProductGroups
     * @see API Reference: https://api.seravo.com/public/docs#/Product%20groups/get_many_public_product_groups__get
     */
    public function get(): ProductGroupCollection
    {
        return $this->api->get(uri: $this->uri, responseClass: ProductGroupCollection::class);
    }

    /**
     * Return a single ProductGroup
     * @see API Reference: https://api.seravo.com/public/docs#/Product%20groups/get_one_public_product_groups__name__get
     */
    public function getByName(string $name): ProductGroup
    {
        return $this->api->get(uri: $this->uri . $name, responseClass: ProductGroup::class);
    }

    /**
     * Get product group's products
     * @see API Reference:
     * https://api.seravo.com/public/docs#/Product%20groups/get_nested_public_product_groups__name__products__get
     */
    public function getProducts(string $name): ProductCollection
    {
        return $this->api->get(uri: $this->uri . $name . '/products/', responseClass: ProductCollection::class);
    }
}
