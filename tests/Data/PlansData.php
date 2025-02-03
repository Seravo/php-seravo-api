<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class PlansData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetPlans(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/plans/plans.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetPlan(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/plans/plan.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
