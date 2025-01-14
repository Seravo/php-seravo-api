<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request\Order;

readonly class UpdateOrderRequest extends OrderRequest
{
    public function __construct(
        public ?string $id = null,
        mixed ...$args,
    ) {
        parent::__construct(...$args);
    }
}
