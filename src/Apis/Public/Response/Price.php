<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Apis\Public\Response\PricePlan;

readonly class Price extends AbstractResponse
{
    /**
     * @param PriceDomain[] $domains
     * @param PriceProduct[] $products
     */
    public function __construct(
        public string $id,
        public int $interval,
        public string $total,
        public array $products,
        public PricePlan $plan,
        public array $domains,
        public ?\DateTime $created_at,
        public ?\DateTime $updated_at = null,
        public ?string $promotion = null
    ) {
    }
}
