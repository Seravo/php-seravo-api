<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Billing;

use Seravo\SeravoApi\Concerns\CastableToArray;

abstract class BillingMethod
{
    use CastableToArray;

    public function __construct(
        public readonly string $contactEmail,
        public readonly string $contactName,
        public readonly string $contactPhone,
        public readonly string $option,
    ) {
    }
}
