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
        public string $promotion_code,
        public string $promotion_type,
        public string $id,
        public \DateTime $created_at,
        public array $plans = [],
        public ?string $account_manager = null,
        public ?string $deploy_location = null,
        public ?string $template = null,
        public ?string $whitelabel = null,
        public ?string $wp_admin_username = null,
        public ?string $reseller_id = null,
        public ?\DateTime $updated_at = null,
        public ?Reseller $reseller = null,
        public ?array $coupons = null,
    ) {
    }
}
