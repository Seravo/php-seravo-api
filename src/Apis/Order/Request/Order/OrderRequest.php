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
        public bool $acceptServiceTerms,
        public array $domains,
        public Contact $contact,
        public bool $migration,
        public string $orderLanguage,
        public string $siteLocation,
        public string $priceData,
        public BillingMethod $billing,
        public Company $company,
        public Mail $mail,
        public ?int $orderTrialPeriod = 0,
        public ?string $affiliateId = null,
        public ?string $externalCustomerId = null,
        public ?string $message = null,
        public ?string $missAffiliateId = null,
        public ?string $requestId = null,
        public ?int $serviceId = null,
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
