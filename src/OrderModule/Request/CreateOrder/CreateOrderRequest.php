<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request\CreateOrder;

use Seravo\SeravoApi\OrderModule\Request\AbstractRequest;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Contact;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Billing\BillingMethod;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Company;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Mail;

class CreateOrderRequest extends AbstractRequest
{
    protected string $method = 'post';

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
        // public readonly BillingMethod $billing,
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
    public function toArray(): array
    {
        $array = [
            'accept_service_terms' => $this->acceptServiceTerms,
            'additional_domains'   => $this->additionalDomains,
            'contact'              => $this->contact->toArray(),
            'migration'            => $this->migration,
            'order_language'       => $this->orderLanguage,
            'order_trial_period'   => $this->orderTrialPeriod,
            'primary_domain'       => $this->primaryDomain,
            'site_location'        => $this->siteLocation,
            'affiliate_id'         => $this->affiliateId,
            'external_customer_id' => $this->externalCustomerId,
            'message'              => $this->message,
            'miss_affiliate_id'    => $this->missAffiliateId,
            'request_id'           => $this->requestId,
            'service_id'           => $this->serviceId,
            'price_data'           => $this->priceData,
            // 'billing'              => $this->billing->toArray(),
            'company'              => $this->filterEmpty($this->company->toArray()),
            'mail'                 => $this->mail->toArray()
        ];

        return ['form_params' => $this->filterEmpty($array)];
    }
}
