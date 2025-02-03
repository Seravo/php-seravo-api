<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class PricesData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataCreatePrice(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/prices/price.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetPrice(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/prices/price.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
