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
        $json = file_get_contents(__DIR__ . '/../MockData/orders/orders.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetOrder(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/orders/order.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataCreateOrder(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/orders/order.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataUpdateOrder(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/orders/order.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
