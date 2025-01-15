<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\AdditionalService;

use Seravo\SeravoApi\Concerns\ArrayTransformer;

abstract readonly class AdditionalServiceRequest implements \JsonSerializable
{
    use ArrayTransformer;

    /**
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray($this);
    }
}
