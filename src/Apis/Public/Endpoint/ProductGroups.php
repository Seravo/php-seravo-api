<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Apis\Public\Response\Product;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroup;
use Seravo\SeravoApi\Enums\ApiEndpoint;

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
     * @return array<int, ProductGroup>
     */
    public function get(): array
    {
        return $this->api->get(uri: $this->uri, responseClass: ProductGroup::class);
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
     * @return array<int, Product>
     */
    public function getProducts(string $name): array
    {
        return $this->api->get(uri: $this->uri . $name . '/products/', responseClass: Product::class);
    }
}
