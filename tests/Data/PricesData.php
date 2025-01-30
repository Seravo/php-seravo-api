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
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/prices/price.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetPrice(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/prices/price.json'),
            true
        );
    }
}
