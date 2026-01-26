<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Plan extends AbstractResponse
{
    public function __construct(
        public string $id,
        public bool $account_manager,
        public int $disklimit,
        public int $emails_sent,
        public int|null $httplimit,
        public string $monitor_interval,
        public string $name,
        public bool $network,
        public int $network_subsites,
        public int $php_max_workers,
        public int $price,
        public bool $private,
        public int $redis_max_mem,
        public string $security_sla,
        public int $shadowlimit,
        public string $site_sla,
        public int $visitors_per_month,
        public bool $woocommerce,
        public \DateTime $created_at,
        public ?\DateTime $updated_at = null,
    ) {
    }
}
