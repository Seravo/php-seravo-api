<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\Order\Request\Order\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\UpdateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Response\Order\Order;
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
     * @param CreateOrderRequest $request
     * @return Order
     */
    public function create(CreateOrderRequest $request): Order
    {
        return $this->orderApi->request(
            method: HttpMethod::Post,
            uri: $this->uri,
            body: $request,
            responseClass: Order::class
        );
    }

    /**
     * Return all Orders
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_many_order_orders__get
     * @return array<int, Order>
     */
    public function get(): array
    {
        return $this->orderApi->request(
            method: HttpMethod::Get,
            uri: $this->uri,
            responseClass: Order::class
        );
    }

    /**
     * Return a single Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_one_order_orders__id__get
     * @param string $id - UUID
     * @return Order
     */
    public function getById(string $id): Order
    {
        return $this->orderApi->request(
            method: HttpMethod::Get,
            uri: $this->uri . $id,
            responseClass: Order::class
        );
    }

    /**
     * Create/update an Order
     * API Reference: https://api.seravo.dev/order/docs#/Orders/update_order_orders__id__put
     * @param string $id - UUID
     * @param UpdateOrderRequest $request
     * @return Order
     */
    public function update(string $id, UpdateOrderRequest $request): Order
    {
        return $this->orderApi->request(
            method: HttpMethod::Put,
            uri: $this->uri . $id,
            body: $request,
            responseClass: Order::class
        );
    }
}
