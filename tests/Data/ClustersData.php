<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class ClustersData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetClusters(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/clusters/clusters.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
