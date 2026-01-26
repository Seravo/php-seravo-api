<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Domain extends AbstractResponse
{
    public function __construct(
        public string $name,
        public bool $primary,
        public ?string $dns_zone = null,
        public ?string $transfer_key = null,
    ) {
    }
}
