<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request;

use Seravo\SeravoApi\Enums\OrderStatus;

class OrderStatusRequest
{
    public function __construct(
        public string|OrderStatus $orderStatus,
    ) {
        $this->orderStatus = $orderStatus->value;
    }
}
