<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

readonly class Contact
{
    public function __construct(
        public string $email,
        public string $name,
        public string $phone,
    ) {
    }
}
