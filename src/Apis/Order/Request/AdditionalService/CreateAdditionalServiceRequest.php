<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\AdditionalService;

readonly class CreateAdditionalServiceRequest extends AdditionalServiceRequest
{
    /**
     *
     * @param array<string> $transferKeys
     */
    public function __construct(
        public array $transferKeys,
        public string $dnsZone
    ) {
    }
}
