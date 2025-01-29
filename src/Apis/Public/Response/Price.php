<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<Price> */
readonly class Price implements SeravoResponseInterface
{
    /**
     * @param PriceProduct[] $products
     */
    public function __construct(
        public string $id,
        public int $interval,
        public string $total,
        public array $products,
        public ?\DateTime $createdAt = null,
        public ?\DateTime $updatedAt = null,
        public ?string $promotion = null
    ) {
    }
}
