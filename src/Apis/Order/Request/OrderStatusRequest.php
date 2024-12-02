<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request;

use Seravo\SeravoApi\Enums\OrderStatusEnum;

class OrderStatusRequest
{
    public function __construct(
        public string|OrderStatusEnum $orderStatus,
    ) {
        $this->orderStatus = $orderStatus->value;
    }
}
