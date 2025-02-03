<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class PromotionsData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetPromotions(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/promotions/promotions.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetPromotion(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/promotions/promotion.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
