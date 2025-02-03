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
        $json = file_get_contents(__DIR__ . '/../MockData/affiliates/affiliates.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetAffiliate(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/affiliates/affiliate.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
