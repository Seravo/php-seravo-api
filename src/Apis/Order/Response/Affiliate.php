<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Affiliate extends AbstractResponse
{
    public function __construct(
        public string $name,
        public string $partner_id,
        public \DateTime $created_at,
        public string $id,
        public ?\DateTime $updated_at = null,
        public ?\DateTime $deleted_at = null,
    ) {
    }
}
