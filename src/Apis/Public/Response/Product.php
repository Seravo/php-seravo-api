<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<Product> */
readonly class Product implements SeravoResponseInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public int $price,
        public string $code,
        public string $type,
        public string $unit,
        public \stdClass $locale,
        public string $productType,
        public \DateTime $createdAt,
        public ?\DateTime $updatedAt = null,
        public ?\DateTime $deletedAt = null,
        public ?string $groupId = null
    ) {
    }
}
