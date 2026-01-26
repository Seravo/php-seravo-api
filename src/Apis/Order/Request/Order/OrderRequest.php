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
        public array $domains,
        public Contact $contact,
        public bool $migration,
        public string $order_language,
        public string $site_location,
        public string $price_data,
        public BillingMethod $billing,
        public Company $company,
        public Mail $mail,
        public ?int $order_trial_period = 0,
        public ?string $affiliate_id = null,
        public ?string $external_customer_id = null,
        public ?string $message = null,
        public ?string $miss_affiliate_id = null,
        public ?string $request_id = null,
        public ?int $service_id = null,
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
