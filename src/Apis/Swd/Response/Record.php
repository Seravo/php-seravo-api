<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Response;

use Seravo\SeravoApi\Apis\AbstractResponse;

readonly class Record extends AbstractResponse
{
    /**
     * @param array<int, string> $A
     * @param array<int, string> $AAAA
     */
    public function __construct(
        public array $A,
        public array $AAAA,
        public string $CNAME,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'A' => $this->A,
            'AAAA' => $this->AAAA,
            'CNAME' => $this->CNAME,
        ];
    }
}
