<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema;

readonly class Company
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $address = null,
        public ?string $city = null,
        public ?string $email = null,
        public ?string $location = null,
        public ?string $phone = null,
        public ?string $postal = null,
        public ?string $address2 = null
    ) {
    }
}
