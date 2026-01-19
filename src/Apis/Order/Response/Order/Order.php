<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;
use Seravo\SeravoApi\Apis\Public\Response\Price;
use Seravo\SeravoApi\Apis\Order\Response\Order\Domain;

readonly class Order extends AbstractResponse
{
    /**
     * @param Domain[] $domains
     */
    public function __construct(
        public bool $acceptServiceTerms,
        public array $domains,
        public Contact $contact,
        public bool $migration,
        public string $orderLanguage,
        public string $siteLocation,
        public \DateTime $createdAt,
        public string $id,
        public Billing $billing,
        public Company $company,
        public Mail $mail,
        public string $orderStatus,
        public Price $priceData,
        public int $orderTrialPeriod = 0,
        public ?string $affiliateId = null,
        public ?string $externalCustomerId = null,
        public ?string $message = null,
        public ?string $missAffiliateId = null,
        public ?string $requestId = null,
        public ?int $serviceId = null,
        public ?\DateTime $updatedAt = null,
        public ?PromotionCode $promotionCode = null,
        public ?string $paymentUrl = null
    ) {
    }
}
