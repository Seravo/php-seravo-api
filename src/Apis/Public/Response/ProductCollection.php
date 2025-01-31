<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Public\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;
use Seravo\SeravoApi\Apis\Public\Response\Product;

final class ProductCollection extends AbstractCollection
{
    /**
     * @param Product ...$product
     */
    public function __construct(Product ...$product)
    {
        parent::__construct(...$product);
    }
}
