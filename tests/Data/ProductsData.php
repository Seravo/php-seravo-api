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
        $json = file_get_contents(__DIR__ . '/../MockData/products/products.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetProduct(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/products/product.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
