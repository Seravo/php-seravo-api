<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class PriceProduct extends AbstractResponse
{
    public function __construct(
        public string $name,
        public string $code,
        public string $price,
        public string $discount
    ) {
    }
}
