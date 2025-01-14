<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order;

use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\BillingMethod;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;
use Seravo\SeravoApi\Concerns\ArrayTransformer;

class CreateOrderRequest implements \JsonSerializable
{
    use ArrayTransformer;

    /**
     *
     * @param array<string>|null $additionalDomains
     */
    public function __construct(
        public readonly bool $acceptServiceTerms,
        public readonly Contact $contact,
        public readonly bool $migration,
        public readonly string $orderLanguage,
        public readonly string $primaryDomain,
        public readonly string $siteLocation,
        public readonly string $priceData,
        public readonly BillingMethod $billing,
        public readonly Company $company,
        public readonly Mail $mail,
        public readonly ?array $additionalDomains = [],
        public readonly ?int $orderTrialPeriod = 0,
        public readonly ?string $affiliateId = null,
        public readonly ?string $externalCustomerId = null,
        public readonly ?string $message = null,
        public readonly ?string $missAffiliateId = null,
        public readonly ?string $requestId = null,
        public readonly ?int $serviceId = null,
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
