<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Endpoint;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Apis\Order\Request\Order\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\UpdateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Response\Order\Order;
use Seravo\SeravoApi\Apis\Order\Response\Order\OrderCollection;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Enums\OrderStatus;
use Seravo\SeravoApi\Enums\SortDirection;

class Orders
{
    private string $uri;

    public function __construct(
        private readonly OrderApi $api
    ) {
        $this->uri = $this->api->setUri(ApiEndpoint::Orders);
    }

    /**
     * Create a new Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/create_order_orders__post
     * @param CreateOrderRequest $request
     * @return Order
     */
    public function create(CreateOrderRequest $request): Order
    {
        return $this->api->post(uri: $this->uri, body: $request, responseClass: Order::class);
    }

    /**
     * Return Orders
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_many_order_orders__get
     *
     * @param int                 $page    Page number (defaults to 1)
     * @param int                 $limit   Number of items per page; 0 disables paging
     * @param string|null         $site_location    Optional site location filter
     * @param OrderStatus|null    $order_status Optional order status filter
     * @param array<string, SortDirection>  $sort    Optional sort fields
     * @return OrderCollection
     */
    public function get(
        int $page = 1,
        int $limit = 0,
        ?string $site_location = null,
        ?OrderStatus $order_status = null,
        array $sort = []
    ): OrderCollection {
        $query = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($site_location !== null) {
            $query['site_location'] = $site_location;
        }

        if ($order_status !== null) {
            $query['order_status'] = $order_status->value;
        }

        $uri = $this->api->buildUriWithParams(baseUri: $this->uri, query: $query, sort: $sort);
        return $this->api->get(uri: $uri, responseClass: OrderCollection::class);
    }

    /**
     * Return a single Order
     * @see API Reference: https://api.seravo.dev/order/docs#/Orders/get_one_order_orders__id__get
     * @param string $id - UUID
     * @return Order
     */
    public function getById(string $id): Order
    {
        return $this->api->get(uri: $this->uri . $id, responseClass: Order::class);
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
        return $this->api->put(uri: $this->uri . $id, body: $request, responseClass: Order::class);
    }
}
