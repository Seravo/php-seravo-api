<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class AdditionalService extends AbstractResponse
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
