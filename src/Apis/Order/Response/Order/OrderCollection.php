<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response\Order;

use Seravo\SeravoApi\Apis\AbstractCollection;
use Seravo\SeravoApi\Apis\Order\Response\Order\Order;

final class OrderCollection extends AbstractCollection
{
    /**
     * @param Order ...$order
     */
    public function __construct(Order ...$order)
    {
        parent::__construct(...$order);
    }
}
