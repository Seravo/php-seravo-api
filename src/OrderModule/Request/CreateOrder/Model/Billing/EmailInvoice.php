<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Billing;

class EmailInvoice extends BillingMethod
{
    public const BILLING_METHOD = 'email';

    public function __construct(string $contactEmail, string $contactName, string $contactPhone)
    {
        parent::__construct($contactEmail, $contactName, $contactPhone, self::BILLING_METHOD);
    }
}
