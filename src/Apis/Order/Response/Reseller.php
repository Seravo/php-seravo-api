<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

readonly class Reseller
{
    /**
     * @param array<string> $languages
     * @param array<string> $officeLocations
     * @param array<string> $webhooks
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $businessId,
        public string $domain,
        public string $organisationId,
        public \DateTime $createdAt,
        public string $id,
        public array $webhooks,
        public ?string $projectSize,
        public array $languages = [],
        public array $officeLocations = [],
        public ?string $expertise = null,
        public ?string $internalNotes = null,
        public ?\DateTime $updatedAt = null,
        public ?\DateTime $deletedAt = null,
    ) {
    }
}
