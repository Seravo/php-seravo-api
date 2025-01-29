<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<Affiliate> */
readonly class Affiliate implements SeravoResponseInterface
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
