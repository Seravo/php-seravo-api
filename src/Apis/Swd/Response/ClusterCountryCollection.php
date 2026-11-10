<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Swd\Response;

use Seravo\SeravoApi\Apis\AbstractCollection;

final class ClusterCountryCollection extends AbstractCollection
{
    /**
     * @param ClusterCountry ...$clusterCountry
     */
    public function __construct(ClusterCountry ...$clusterCountry)
    {
        parent::__construct(...$clusterCountry);
    }
}
