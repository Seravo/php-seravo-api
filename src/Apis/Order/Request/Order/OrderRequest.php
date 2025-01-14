<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order;

use Seravo\SeravoApi\Concerns\ArrayTransformer;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\BillingMethod;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;

abstract readonly class OrderRequest implements \JsonSerializable
{
    use ArrayTransformer;

    /**
     *
     * @param array<string>|null $additionalDomains
     */
    public function __construct(
        public bool $acceptServiceTerms,
        public Contact $contact,
        public bool $migration,
        public string $orderLanguage,
        public string $primaryDomain,
        public string $siteLocation,
        public string $priceData,
        public BillingMethod $billing,
        public Company $company,
        public Mail $mail,
        public ?array $additionalDomains = [],
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
