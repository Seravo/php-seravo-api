<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Seravo\SeravoApi\HttpClient\Builder;

class PublicAPI extends BaseAPI
{
    public const ENDPOINT_PREFIX = '/public/';

    public function __construct(
        private readonly string $baseUrl,
        private readonly Builder $httpClientBuilder
    ) {
        parent::__construct($baseUrl, $httpClientBuilder, self::ENDPOINT_PREFIX);
    }
}
