<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\Apis\Swd\Endpoint\Clusters;
use Seravo\SeravoApi\Enums\ApiModule;
use Seravo\SeravoApi\HttpClient\Builder;

class SwdApi extends AbstractApi
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder
    ) {
        parent::__construct($this->baseUrl, $this->httpClientBuilder, ApiModule::Swd);
    }

    public function clusters(): Clusters
    {
        return new Clusters($this);
    }
}
