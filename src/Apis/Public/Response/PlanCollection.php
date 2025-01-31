<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;
use Seravo\SeravoApi\Apis\Public\Response\Plan;

final class PlanCollection extends AbstractCollection
{
    /**
     * @param Plan ...$plan
     */
    public function __construct(Plan ...$plan)
    {
        parent::__construct(...$plan);
    }
}
