<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema;

readonly class Mail
{
    /**
     * Undocumented function
     *
     * @param array<string> $boxes
     * @param array<string> $forwarding_from
     * @param array<string> $forwarding_to
     */
    public function __construct(
        public string $option,
        public array $boxes = [],
        public array $forwarding_from = [],
        public array $forwarding_to = []
    ) {
    }
}
