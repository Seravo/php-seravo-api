<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<PromotionCode> */
readonly class PromotionCode implements SeravoResponseInterface
{
    /**
     *
     * @param array<string> $plans
     */
    public function __construct(
        public string $name,
        public string $promotionCode,
        public string $promotionType,
        public string $id,
        public string $discount = "0",
        public int $trialMonths = 0,
        public bool $freeMigration = false,
        public bool $stagingShadow = false,
        public array $plans = [],
        public ?string $accountManager = null,
        public ?string $deployLocation = null,
        public ?string $template = null,
        public ?string $whitelabel = null,
        public ?string $wpAdminUsername = null,
        public ?string $resellerId = null,
        public ?\DateTime $createdAt = null,
        public ?\DateTime $updatedAt = null,
        public ?Reseller $reseller = null,
    ) {
    }
}
