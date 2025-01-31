<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;
use Seravo\SeravoApi\Apis\Order\Response\Affiliate;

final class AffiliateCollection extends AbstractCollection
{
    /**
     * @param Affiliate ...$affiliate
     */
    public function __construct(Affiliate ...$affiliate)
    {
        parent::__construct(...$affiliate);
    }
}
