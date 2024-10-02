<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Billing;

class EInvoice extends BillingMethod
{
    public const BILLING_METHOD = 'einvoice';

    public function __construct(string $contactEmail, string $contactName, string $contactPhone)
    {
        parent::__construct($contactEmail, $contactName, $contactPhone, self::BILLING_METHOD);
    }
}
