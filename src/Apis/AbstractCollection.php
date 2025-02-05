<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\Contracts\CollectionInterface;
use Seravo\SeravoApi\Apis\AbstractResponse;

abstract class AbstractCollection implements CollectionInterface
{
    /**
     * @var AbstractResponse[]
     */
    private array $items;

    /**
     * @param AbstractResponse ...$items The items
     */
    public function __construct(AbstractResponse ...$items)
    {
        $this->items = $items;
    }

    /**
     * @param AbstractResponse $item The item
     */
    public function add(AbstractResponse $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Get all items.
     * @return AbstractResponse[] The items
     */
    public function all(): array
    {
        return $this->items;
    }
}
