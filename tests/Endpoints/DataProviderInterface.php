<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\SeravoAPI;

interface DataProviderInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getData(): array;

    /**
     * @param array<int, mixed>|null $requests
     */
    public function createClientHandler(?array $requests): SeravoAPI;
}
