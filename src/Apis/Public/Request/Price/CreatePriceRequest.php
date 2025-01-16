<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Request\Price;

use Seravo\SeravoApi\Concerns\ArrayTransformer;

readonly class CreatePriceRequest implements \JsonSerializable
{
    use ArrayTransformer;

    /**
     *
     * @param array<string> $products
     */
    public function __construct(
        public int $interval,
        public array $products,
        public string $plan,
        public ?string $promotion = null,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray($this);
    }
}
