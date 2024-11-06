<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema;

class Company
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $address = null,
        public readonly ?string $city = null,
        public readonly ?string $email = null,
        public readonly ?string $location = null,
        public readonly ?string $phone = null,
        public readonly ?string $postal = null,
        public readonly ?string $address2 = null
    ) {
    }
}
