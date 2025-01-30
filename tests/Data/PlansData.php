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
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/plans/plans.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataGetPlan(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/plans/plan.json'),
            true
        );
    }
}
