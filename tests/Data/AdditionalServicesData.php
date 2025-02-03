<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Data;

use Seravo\Tests\SeravoApi\Endpoints\DataProvider;

class AdditionalServicesData extends DataProvider
{
    /**
     * @return array<string, mixed>
     */
    public function dataGetAdditionalService(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/additionalservices/additional_service.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataCreateAdditionalService(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/additionalservices/additional_service.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }

    /**
     * @return array<string, mixed>
     */
    public function dataEditAdditionalService(): array
    {
        $json = file_get_contents(__DIR__ . '/../MockData/additionalservices/additional_service.json');
        if ($json === false) {
            throw new \RuntimeException('Failed to read the JSON file');
        }

        return json_decode($json, true);
    }
}
