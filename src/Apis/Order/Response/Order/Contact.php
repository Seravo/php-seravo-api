<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Contact extends AbstractResponse
{
    public function __construct(
        public string $email,
        public string $name,
        public string $phone,
    ) {
    }
}
