<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request;

use Seravo\SeravoApi\Enums\OrderStatus;

class OrderStatusRequest implements \JsonSerializable
{
    public function __construct(
        public OrderStatus $orderStatus,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'order_status' => $this->orderStatus->value
        ];
    }
}
