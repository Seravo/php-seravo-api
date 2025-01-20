<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing;

use Seravo\SeravoApi\Enums\BillingMethod as BillingMethodEnum;

class PaperInvoice extends BillingMethod
{
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
        parent::__construct($contactEmail, $contactName, $contactPhone, BillingMethodEnum::Paper->value);
    }
}
