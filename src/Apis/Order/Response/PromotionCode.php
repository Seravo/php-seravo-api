<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Apis\Order\Response\Coupon;

readonly class PromotionCode extends AbstractResponse
{
    /**
     *
     * @param array<string> $plans
     * @param array<Coupon> $coupons
     */
    public function __construct(
        public string $name,
        public string $promotionCode,
        public string $promotionType,
        public string $id,
        public \DateTime $createdAt,
        public array $plans = [],
        public ?string $accountManager = null,
        public ?string $deployLocation = null,
        public ?string $template = null,
        public ?string $whitelabel = null,
        public ?string $wpAdminUsername = null,
        public ?string $resellerId = null,
        public ?\DateTime $updatedAt = null,
        public ?Reseller $reseller = null,
        public ?array $coupons = null,
    ) {
    }
}
