<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;
use Seravo\SeravoApi\Apis\Public\Response\ProductGroup;

final class ProductGroupCollection extends AbstractCollection
{
    /**
     * @param ProductGroup ...$productGroup
     */
    public function __construct(ProductGroup ...$productGroup)
    {
        parent::__construct(...$productGroup);
    }
}
