<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing;

abstract class BillingMethod
{
    public function __construct(
        public string $contact_email,
        public string $contact_name,
        public string $contact_phone,
        public string $option,
    ) {
    }
}
