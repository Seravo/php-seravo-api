<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use DateTime;
use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Mail extends AbstractResponse
{
    /**
     * @param array<string> $boxes
     * @param array<string> $forwarding_from
     * @param array<string> $forwarding_to
     */
    public function __construct(
        public array $boxes = [],
        public array $forwarding_from = [],
        public array $forwarding_to = [],
        public ?string $option = null,
    ) {
    }
}
