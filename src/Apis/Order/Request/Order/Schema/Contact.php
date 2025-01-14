<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema;

class Contact
{
    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly string $phone
    ) {
    }
}
