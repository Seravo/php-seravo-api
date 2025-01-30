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
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/productgroups/product_groups.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetProductGroup(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/productgroups/product_group.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetProductGroupsProducts(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/productgroups/product_groups_products.json'),
            true
        );
    }
}
