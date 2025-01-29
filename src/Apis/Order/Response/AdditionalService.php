<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<AdditionalService> */
readonly class AdditionalService implements SeravoResponseInterface
{
    /**
     * @param array<string> $transferKeys
     */
    public function __construct(
        public string $dnsZone,
        public ?array $transferKeys = [],
        public ?\DateTime $createdAt = null,
        public ?\DateTime $updatedAt = null,
    ) {
    }
}
