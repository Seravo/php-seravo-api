<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Concerns;

trait CastableToArray
{
    /**
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
