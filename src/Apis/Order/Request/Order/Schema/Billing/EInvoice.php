<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing;

use Seravo\SeravoApi\Enums\BillingMethod as BillingMethodEnum;

class EInvoice extends BillingMethod
{
    public function __construct(
        public string $contact_email,
        public string $contact_name,
        public string $contact_phone,
        public string $invoice,
        public string $operator,
        public ?string $address = null,
        public ?string $address2 = null,
        public ?string $city = null,
        public ?string $email = null,
        public ?string $name = null,
        public ?string $postal = null,
    ) {
        parent::__construct($contact_email, $contact_name, $contact_phone, BillingMethodEnum::EInvoice->value);
    }
}
