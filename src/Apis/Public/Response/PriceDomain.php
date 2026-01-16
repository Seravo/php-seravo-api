<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class PriceDomain extends AbstractResponse
{
    public function __construct(
        public string $name,
        public bool $primary,
        public string $id,
        public string $price,
        public string $code,
        public ?string $type,
        public ?string $discount
    ) {
    }
}
