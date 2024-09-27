<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule;

use GuzzleHttp\ClientInterface;
use Seravo\SeravoApi\OrderModule\Api\Orders;
use Seravo\SeravoApi\OrderModule\HttpClient\Client as HttpClient;
final class Client
{
    private HttpClient $httpClient;

    public function __construct(
        public readonly string $baseUrl,
        public readonly string $oidcToken,
    ) {
        $this->httpClient = new HttpClient($this->baseUrl, $this->oidcToken);
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient->getHttpClient();
    }

    public function orders(): Orders
    {
        return new Orders($this);
    }
}
