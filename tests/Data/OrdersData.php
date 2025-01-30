<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class OrdersData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetOrders(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/orders/orders.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetOrder(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/orders/order.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataCreateOrder(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/orders/order.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataUpdateOrder(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/orders/order.json'),
            true
        );
    }
}
