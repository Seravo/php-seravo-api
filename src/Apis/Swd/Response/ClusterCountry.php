<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class ClusterCountry extends AbstractResponse
{
    public function __construct(
        public string $country,
    ) {
    }
}
