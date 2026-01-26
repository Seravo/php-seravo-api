<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Request\Price;

use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Enums\DomainType;

readonly class Domain extends AbstractResponse
{
    public function __construct(
        public string $name,
        public bool $primary,
        public ?string $type,
    ) {
    }
}
