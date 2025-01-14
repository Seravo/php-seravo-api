<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing;

class EmailInvoice extends BillingMethod
{
    public const BILLING_METHOD = 'email';

    public function __construct(
        public string $contactEmail,
        public string $contactName,
        public string $contactPhone,
        public string $email,
        public ?string $invoice = null,
        public ?string $operator = null,
        public ?string $address = null,
        public ?string $address2 = null,
        public ?string $city = null,
        public ?string $name = null,
        public ?string $postal = null
    ) {
        parent::__construct($contactEmail, $contactName, $contactPhone, self::BILLING_METHOD);
    }
}
