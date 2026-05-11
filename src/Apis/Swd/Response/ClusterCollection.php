<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;

final class ClusterCollection extends AbstractCollection
{
    /**
     * @param Cluster ...$cluster
     */
    public function __construct(Cluster ...$cluster)
    {
        parent::__construct(...$cluster);
    }
}
