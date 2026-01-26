<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Reseller extends AbstractResponse
{
    /**
     * @param array<string> $languages
     * @param array<string> $office_locations
     * @param array<string> $webhooks
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $business_id,
        public string $domain,
        public string $organisation_id,
        public \DateTime $created_at,
        public string $id,
        public array $webhooks,
        public ?string $project_size,
        public array $languages = [],
        public array $office_locations = [],
        public ?string $expertise = null,
        public ?string $internal_notes = null,
        public ?\DateTime $updated_at = null,
        public ?\DateTime $deleted_at = null,
        public ?\stdClass $contact_information = null,
    ) {
    }
}
