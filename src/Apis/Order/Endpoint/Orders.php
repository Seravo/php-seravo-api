<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderAPI;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\CreateOrderRequest;

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
        return $this->orderApi->request('POST', $this->uri, [], $request->toArray());
    }

    /**
     * Return all Orders
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_many_order_orders__get
     *
     * @return array<mixed, mixed>
     */
    public function get(): array
    {
        return $this->orderApi->request('GET', $this->uri);
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
        return $this->orderApi->request('GET', $this->uri . $id);
    }

    /**
     * Update an Order
     * API Reference: https://api.seravo.dev/order/docs#/Orders/update_order_orders__id__put
     *
     * @return array
     */
    // public function update(int $id, CreateOrderRequest $request): array
    // {
    //     $url = self::ENDPOINT . '/' . $id;

    //     return $this->request($url, $request);
    // }

    /**
     * Change (Update) an Orders Status
     * @see API Reference:  https://api.seravo.dev/order/docs#/Orders/order_status_order_orders__id__status_post
     *
     * @return void
     */
    // public function status(int $id): void
    // {
    //     $url = self::ENDPOINT . '/' . $id . '/status';
    //     // TODO: Implement this
    // }

}
