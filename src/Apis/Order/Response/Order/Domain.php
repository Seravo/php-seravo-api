<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Domain extends AbstractResponse
{
    public function __construct(
        public string $name,
        public bool $primary,
        public ?string $dnsZone = null,
        public ?string $transferKey = null,
    ) {
    }
}
