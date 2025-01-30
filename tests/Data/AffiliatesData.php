<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class AffiliatesData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetAffiliates(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/affiliates/affiliates.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetAffiliate(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/affiliates/affiliate.json'),
            true
        );
    }
}
