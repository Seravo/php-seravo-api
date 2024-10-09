<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Billing;

class EInvoice extends BillingMethod
{
    public const BILLING_METHOD = 'einvoice';

    public function __construct(
        public string $contactEmail,
        public string $contactName,
        public string $contactPhone,
        public string $invoice,
        public string $operator,
        public ?string $address = null,
        public ?string $address2 = null,
        public ?string $city = null,
        public ?string $email = null,
        public ?string $name = null,
        public ?string $postal = null
    ) {
        parent::__construct($contactEmail, $contactName, $contactPhone, self::BILLING_METHOD);
    }
}
