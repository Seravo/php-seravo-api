<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;

readonly class Coupon extends AbstractResponse
{
    public function __construct(
        public string $type,
        public int $duration,
        public string $id,
        public string $promotion_code_id,
        public string $product_id,
        public string $product_group_id,
        public string $discount,
        public string $amount_off,
        public string $valid_before,
        public string $valid_after,
        public PromotionCode|null $promotion_code,
        public \DateTime $created_at,
        public ?\DateTime $updated_at = null,
    ) {
    }
}
