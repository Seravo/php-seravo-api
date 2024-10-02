<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model;

use Seravo\SeravoApi\Concerns\CastableToArray;

class Contact
{
    use CastableToArray;

    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly string $phone
    ) {
    }
}
