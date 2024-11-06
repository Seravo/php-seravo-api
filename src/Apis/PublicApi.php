<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\HttpClient\Builder;

class PublicApi extends AbstractApi
{
    public const ENDPOINT_PREFIX = '/public/';

    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder
    ) {
        parent::__construct($this->baseUrl, $this->httpClientBuilder, self::ENDPOINT_PREFIX);
    }
}
