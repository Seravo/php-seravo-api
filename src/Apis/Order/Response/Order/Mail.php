<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use DateTime;

readonly class Mail
{
    /**
     * @param array<string> $boxes
     * @param array<string> $forwardingFrom
     * @param array<string> $forwardingTo
     */
    public function __construct(
        public array $boxes = [],
        public array $forwardingFrom = [],
        public array $forwardingTo = [],
        public ?string $option = null,
    ) {
    }
}
