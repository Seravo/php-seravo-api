<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Api;

use Seravo\SeravoApi\OrderModule\Request\CreateOrder\CreateOrderRequest;

final class Orders extends AbstractApi
{
    private const ENDPOINT = '/order/orders';

    /**
     * Create a new Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/create_order_orders__post
     *
     * @return array<string, mixed>
     */
    public function create(CreateOrderRequest $request): array
    {
        return $this->request(self::ENDPOINT, $request);
    }

    /**
     * Return all Orders
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_many_order_orders__get
     *
     * @return void
     */
    public function get(): void
    {
        // TODO: Implement this
    }

    /**
     * Return a single Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_one_order_orders__id__get
     *
     * @return void
     */
    public function getById(int $id): void
    {
        // TODO: Implement this
    }

    /**
     * Update an Order
     * API Reference: https://api.seravo.dev/order/docs#/Orders/update_order_orders__id__put
     *
     * @return void
     */
    public function update(int $id): void
    {
        // TODO: Implement this
    }

    /**
     * Change an Orders Status
     * @see API Reference:  https://api.seravo.dev/order/docs#/Orders/order_status_order_orders__id__status_post
     *
     * @return void
     */
    public function status(int $id): void
    {
        // TODO: Implement this
    }
}
