<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Endpoint;

use Seravo\SeravoApi\Apis\PublicApi;
use Seravo\SeravoApi\Apis\Public\Request\Price\CreatePriceRequest;
use Seravo\SeravoApi\Apis\Public\Response\Price;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Prices
{
    private readonly string $uri;

    public function __construct(
        private readonly PublicApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Prices);
    }

    /**
     * Create a new Price
     * @see API Reference: https://api.seravo.com/public/docs#/Prices/create_public_prices__post
     * @param CreatePriceRequest $request
     * @return Price
     */
    public function create(CreatePriceRequest $request): Price
    {
        return $this->api->post(uri: $this->uri, body: $request, responseClass: Price::class);
    }

    /**
     * Return a single Price
     * @see API Reference: https://api.seravo.dev/public/docs#/Prices/get_one_public_prices__id__get
     * @param string $id - UUID
     * @return Price
     */
    public function getById(string $id): Price
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: Price::class);
    }
}
