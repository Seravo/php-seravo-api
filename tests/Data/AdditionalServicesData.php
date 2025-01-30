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
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/additionalservices/additional_service.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataCreateAdditionalService(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/additionalservices/additional_service.json'),
            true
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function dataEditAdditionalService(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../MockData/additionalservices/additional_service.json'),
            true
        );
    }
}
