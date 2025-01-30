<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Contracts;

interface SeravoResponseInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
