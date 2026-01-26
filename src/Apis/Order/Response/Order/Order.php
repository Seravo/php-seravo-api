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
        public bool $accept_service_terms,
        public array $domains,
        public Contact $contact,
        public bool $migration,
        public string $order_language,
        public string $site_location,
        public \DateTime $created_at,
        public string $id,
        public Billing $billing,
        public Company $company,
        public Mail $mail,
        public string $order_status,
        public Price $price_data,
        public int $order_trial_period = 0,
        public ?string $affiliate_id = null,
        public ?string $external_customer_id = null,
        public ?string $message = null,
        public ?string $miss_affiliate_id = null,
        public ?string $request_id = null,
        public ?int $service_id = null,
        public ?\DateTime $updated_at = null,
        public ?PromotionCode $promotion_code = null,
        public ?string $payment_url = null
    ) {
    }
}
