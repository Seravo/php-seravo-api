<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class ProductGroupsData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetProductGroups(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/productgroups/product_groups.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetProductGroup(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/productgroups/product_group.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetProductGroupsProducts(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/productgroups/product_groups_products.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
