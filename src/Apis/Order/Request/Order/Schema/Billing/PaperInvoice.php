<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing;

use Seravo\SeravoApi\Enums\BillingMethod as BillingMethodEnum;

class PaperInvoice extends BillingMethod
{
    public function __construct(
        public string $contact_email,
        public string $contact_name,
        public string $contact_phone,
        public string $address,
        public string $city,
        public string $name,
        public string $postal,
        public ?string $email = null,
        public ?string $invoice = null,
        public ?string $operator = null,
        public ?string $address2 = null,
        public ?string $reference = null,
    ) {
        parent::__construct($contact_email, $contact_name, $contact_phone, BillingMethodEnum::Paper->value);
    }
}
