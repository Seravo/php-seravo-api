<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\AdditionalService;

readonly class EditAdditionalServiceRequest extends AdditionalServiceRequest
{
    /**
     *
     * @param array<string>|null $transferKeys
     */
    public function __construct(
        public ?array $transferKeys = null,
        public ?string $dnsZone = null
    ) {
    }
}
