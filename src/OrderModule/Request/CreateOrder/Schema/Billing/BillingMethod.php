<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder\Schema\Billing;

use Seravo\SeravoApi\Concerns\CastableToArray;

abstract class BillingMethod
{
    use CastableToArray;

    public function __construct(
        public string $contactEmail,
        public string $contactName,
        public string $contactPhone,
        public string $option,
    ) {
    }
}
