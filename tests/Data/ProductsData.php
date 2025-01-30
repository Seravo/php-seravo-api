<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class ProductsData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetProducts(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/products/products.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetProduct(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/products/product.json'),
            true
        );
    }
}
