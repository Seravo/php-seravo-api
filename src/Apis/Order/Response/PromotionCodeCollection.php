<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;
use Seravo\SeravoApi\Apis\Order\Response\PromotionCode;

final class PromotionCodeCollection extends AbstractCollection
{
    public function __construct(PromotionCode ...$promotionCode)
    {
        parent::__construct(...$promotionCode);
    }
}
