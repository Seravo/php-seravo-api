<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order\Schema;

readonly class Mail
{
    /**
     * Undocumented function
     *
     * @param array<string> $boxes
     * @param array<string> $forwardingFrom
     * @param array<string> $forwardingTo
     */
    public function __construct(
        public string $option,
        public array $boxes = [],
        public array $forwardingFrom = [],
        public array $forwardingTo = []
    ) {
    }
}
