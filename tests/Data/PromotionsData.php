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
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/promotions/promotions.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetPromotion(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/promotions/promotion.json'),
            true
        );
    }
}
