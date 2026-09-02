<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Billing extends AbstractResponse
{
    public function __construct(
        public ?string $contact_email = null,
        public ?string $contact_name = null,
        public ?string $contact_phone = null,
        public ?string $option = null,
        public ?string $address = null,
        public ?string $address2 = null,
        public ?string $city = null,
        public ?string $email = null,
        public ?string $invoice = null,
        public ?string $name = null,
        public ?string $operator = null,
        public ?string $postal = null,
        public ?string $reference = null,
    ) {
    }
}
