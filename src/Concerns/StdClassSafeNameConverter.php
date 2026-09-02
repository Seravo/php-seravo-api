<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Concerns;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

/**
 * Skips camelCase-to-snake_case conversion for stdClass attributes, since those keys
 * are dynamic data (e.g. currency codes like "EUR") rather than declared property names.
 */
class StdClassSafeNameConverter implements NameConverterInterface
{
    private CamelCaseToSnakeCaseNameConverter $inner;

    public function __construct()
    {
        $this->inner = new CamelCaseToSnakeCaseNameConverter();
    }

    /**
     * @param array<string, mixed> $context
     */
    public function normalize(
        string $propertyName,
        ?string $class = null,
        ?string $format = null,
        array $context = []
    ): string {
        if (\stdClass::class === $class) {
            return $propertyName;
        }

        return $this->inner->normalize($propertyName);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(
        string $propertyName,
        ?string $class = null,
        ?string $format = null,
        array $context = []
    ): string {
        if (\stdClass::class === $class) {
            return $propertyName;
        }

        return $this->inner->denormalize($propertyName);
    }
}
