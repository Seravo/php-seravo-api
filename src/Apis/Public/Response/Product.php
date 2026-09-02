<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Product extends AbstractResponse
{
    public function __construct(
        public string $id,
        public string $name,
        public int $price,
        public string $code,
        public string $type,
        public string $unit,
        public \stdClass $locale,
        public string $product_type,
        public \DateTime $created_at,
        public ?\stdClass $formatted_prices = null,
        public ?\DateTime $updated_at = null,
        public ?\DateTime $deleted_at = null,
        public ?string $group_id = null,
        public ?\stdClass $metadata = null,
    ) {
    }
}
