<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema;

use Seravo\SeravoApi\Concerns\CastableToArray;

class Mail
{
    use CastableToArray;

    /**
     * Undocumented function
     *
     * @param array<string> $boxes
     * @param array<string> $forwardingFrom
     * @param array<string> $forwardingTo
     */
    public function __construct(
        public readonly string $option,
        public readonly array $boxes = [],
        public readonly array $forwardingFrom = [],
        public readonly array $forwardingTo = []
    ) {
    }
}
