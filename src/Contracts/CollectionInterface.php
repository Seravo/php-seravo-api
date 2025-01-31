<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Contracts;

use Seravo\SeravoApi\Apis\AbstractResponse;

interface CollectionInterface
{
    public function add(AbstractResponse $item): void;

    /**
     *
     * @return AbstractResponse[] The orders
     */
    public function all(): array;
}
