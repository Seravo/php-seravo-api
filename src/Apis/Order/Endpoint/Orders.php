<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\Order\Request\Order\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\UpdateOrderRequest;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;

class Orders
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $orderApi
    ) {
        $this->uri = $this->orderApi->setUri(ApiEndpoint::Orders);
    }

    /**
     * Create a new Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/create_order_orders__post
     *
     * @return array<string, mixed>
     */
    public function create(CreateOrderRequest $request): array
    {
        return $this->orderApi->request(method: HttpMethod::Post, uri: $this->uri, body: $request);
    }

    /**
     * Return all Orders
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_many_order_orders__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->orderApi->request(method: HttpMethod::Get, uri: $this->uri);
    }

    /**
     * Return a single Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_one_order_orders__id__get
     *
     * @param string $id - Uuid
     * @return array<mixed, mixed>
     */
    public function getById(string $id): array
    {
        return $this->orderApi->request(method: HttpMethod::Get, uri: $this->uri . $id);
    }

    /**
     * Create/update an Order
     * API Reference: https://api.seravo.dev/order/docs#/Orders/update_order_orders__id__put
     *
     * @param string $id - Uuid
     * @return array<string, mixed>
     */
    public function update(string $id, UpdateOrderRequest $request): array
    {
        return $this->orderApi->request(method: HttpMethod::Put, uri: $this->uri . $id, body: $request);
    }
}
