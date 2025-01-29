<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

readonly class Company
{
    public function __construct(
        public ?string $id = null,
        public ?string $address = null,
        public ?string $address2 = null,
        public ?string $email = null,
        public ?string $city = null,
        public ?string $location = null,
        public ?string $name = null,
        public ?string $phone = null,
        public ?string $postal = null,
    ) {
    }
}
