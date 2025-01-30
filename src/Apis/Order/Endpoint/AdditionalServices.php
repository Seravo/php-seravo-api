<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\CreateAdditionalServiceRequest;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\EditAdditionalServiceRequest;
use Seravo\SeravoApi\Apis\Order\Response\AdditionalService;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class AdditionalServices
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Orders);
    }

    /**
     * Create a new AdditionalService
     * @see API Reference: https://api.seravo.com/order/docs#/Order%20Services/create_order_orders__id__services__put
     * @param CreateAdditionalServiceRequest $request
     * @param string $id - UUID
     * @return AdditionalService
     */
    public function create(CreateAdditionalServiceRequest $request, string $id): AdditionalService
    {
        return $this->api->put(
            uri: $this->uri . $id . '/services/',
            body: $request,
            responseClass: AdditionalService::class
        );
    }

    /**
     * Return a single AdditionalService
     * @see API Reference: https://api.seravo.com/order/docs#/Order%20Services/get_one_order_orders__id__services__get
     * @param string $id - UUID
     * @return AdditionalService
     */
    public function getById(string $id): AdditionalService
    {
        return $this->api->get(uri: $this->uri . $id . '/services/', responseClass: AdditionalService::class);
    }

    /**
     * Patch an AdditionalService
     * @see API Reference:  https://api.seravo.com/order/docs#/Order%20Services/patch_order_orders__id__services__patch
     * @param EditAdditionalServiceRequest $request
     * @param string $id - UUID
     * @return AdditionalService
     */
    public function edit(EditAdditionalServiceRequest $request, string $id): AdditionalService
    {
        return $this->api->patch(
            uri: $this->uri . $id . '/services/',
            body: $request,
            responseClass: AdditionalService::class
        );
    }
}
