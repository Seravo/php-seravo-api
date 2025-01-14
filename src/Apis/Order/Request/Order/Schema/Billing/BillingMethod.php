<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing;

abstract class BillingMethod
{
    public function __construct(
        public string $contactEmail,
        public string $contactName,
        public string $contactPhone,
        public string $option,
    ) {
    }
}
