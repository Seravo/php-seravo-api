<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<ProductGroup> */
readonly class ProductGroup implements SeravoResponseInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public \DateTime $createdAt,
        public ?\DateTime $updatedAt = null,
    ) {
    }
}
