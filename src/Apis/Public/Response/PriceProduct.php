<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

readonly class PriceProduct
{
    public function __construct(
        public string $name,
        public string $code,
        public string $price,
        public string $discount
    ) {
    }
}
