<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Apis\Public\Response\Product;
use Seravo\SeravoApi\Apis\Public\Response\ProductCollection;
use Seravo\SeravoApi\Enums\ApiEndpoint;

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
     * @return ProductCollection
     */
    public function get(): ProductCollection
    {
        $response = $this->api->get(uri: $this->uri, responseClass: Product::class);
        return new ProductCollection(...$response);
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
