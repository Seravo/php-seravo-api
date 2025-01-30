<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class ProductGroup extends AbstractResponse
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
