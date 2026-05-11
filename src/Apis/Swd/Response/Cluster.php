<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Cluster extends AbstractResponse
{
    public function __construct(
        public string $id,
        public string $name,
        public string $full_name,
        public string $cluster_domain,
        public string $country,
        public Record $records,
        public \DateTime $created_at,
        public ?string $statuspage_id = null,
        public ?\DateTime $updated_at = null,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $array = parent::toArray();
        $array['records'] = $this->records->toArray();

        return $array;
    }
}
