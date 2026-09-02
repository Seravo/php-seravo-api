<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class PricePlan extends AbstractResponse
{
    public function __construct(
        public string $id,
        public string $name,
        public string $code,
        public string $price,
        public ?string $discount,
        public \stdClass $locale,
        public \stdClass $formatted_prices,
        public ?string $price_without_discount = "0",
    ) {
    }
}
