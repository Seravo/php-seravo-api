<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order;

use Seravo\SeravoApi\Concerns\ArrayTransformer;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\BillingMethod;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Response\Order\Domain;

abstract readonly class OrderRequest implements \JsonSerializable
{
    use ArrayTransformer;

    /**
     *
     * @param array<Domain> $domains
     */
    public function __construct(
        public bool $accept_service_terms,
        public Contact $contact,
        public bool $migration,
        public string $order_language,
        public array $domains,
        public string $price_data,
        public BillingMethod $billing,
        public Company $company,
        public Mail $mail,
        public ?int $order_trial_period = 0,
        public ?string $site_location = null,
        public ?string $affiliate_id = null,
        public ?string $external_customer_id = null,
        public ?string $message = null,
        public ?string $miss_affiliate_id = null,
        public ?string $request_id = null,
        public ?int $service_id = null,
        public bool $subscribed_to_newsletter = false,
        public ?string $revises_id = null,
        public ?string $site_name = null
    ) {
    }

    /**
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray($this);
    }
}
