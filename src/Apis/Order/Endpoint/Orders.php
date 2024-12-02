<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderAPI;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\OrderStatusRequest;

class Orders
{
    private const ENDPOINT_NAME = 'orders';

    private string $uri;

    public function __construct(
        private readonly OrderAPI $orderApi
    ) {
        $this->uri = $this->orderApi->getUri(self::ENDPOINT_NAME);
    }

    /**
     * Create a new Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/create_order_orders__post
     *
     * @return array<string, mixed>
     */
    public function create(CreateOrderRequest $request): array
    {
        return $this->orderApi->request(method: 'POST', uri: $this->uri, body: $request);
    }

    /**
     * Return all Orders
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_many_order_orders__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->orderApi->request(method: 'GET', uri: $this->uri);
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
        return $this->orderApi->request(method: 'GET', uri: $this->uri . $id);
    }

    /**
     * Update an Order
     * API Reference: https://api.seravo.dev/order/docs#/Orders/update_order_orders__id__put
     *
     * @param string $id - Uuid
     * @return array<string, mixed>
     */
    public function update(string $id, CreateOrderRequest $request): array
    {
        return $this->orderApi->request(method: 'PUT', uri: $this->uri . $id, body: $request);
    }

    /**
     * Change (Update) an Orders Status
     * @see API Reference:  https://api.seravo.dev/order/docs#/Orders/order_status_order_orders__id__status_post
     *
     * @param string $id - Uuid
     * @return array<string, mixed>
     */
    public function status(string $id, OrderStatusRequest $request): array
    {
        return $this->orderApi->request(
            method: 'POST',
            uri: $this->uri . $id . '/status',
            body: $request
        );
    }
}
