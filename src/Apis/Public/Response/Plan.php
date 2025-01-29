<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

/** @implements SeravoResponseInterface<Plan> */
readonly class Plan implements SeravoResponseInterface
{
    public function __construct(
        public string $id,
        public bool $accountManager,
        public int $disklimit,
        public int $emailsSent,
        public int|null $httplimit,
        public string $monitorInterval,
        public string $name,
        public bool $network,
        public int $networkSubsites,
        public int $phpMaxWorkers,
        public int $price,
        public bool $private,
        public int $redisMaxMem,
        public string $securitySla,
        public int $shadowlimit,
        public string $siteSla,
        public int $visitorsPerMonth,
        public bool $woocommerce,
        public \DateTime $createdAt,
        public ?\DateTime $updatedAt = null,
    ) {
    }
}
