<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder\Schema\Billing;

class PaperInvoice extends BillingMethod
{
    public const BILLING_METHOD = 'paper';

    public function __construct(
        public string $contactEmail,
        public string $contactName,
        public string $contactPhone,
        public string $address,
        public string $city,
        public string $name,
        public string $postal,
        public ?string $email = null,
        public ?string $invoice = null,
        public ?string $operator = null,
        public ?string $address2 = null,
    ) {
        parent::__construct($contactEmail, $contactName, $contactPhone, self::BILLING_METHOD);
    }
}
