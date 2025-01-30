<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Affiliate extends AbstractResponse
{
    public function __construct(
        public string $name,
        public string $partnerId,
        public \DateTime $createdAt,
        public string $id,
        public ?\DateTime $updatedAt = null,
        public ?\DateTime $deletedAt = null,
    ) {
    }
}
