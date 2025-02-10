<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Contracts;

interface ResponseMapperInterface
{
    public function mapToResponse(string $json, string $responseClass): SeravoResponseInterface;

    public function mapToCollection(string $json, string $responseClass): CollectionInterface;
}
