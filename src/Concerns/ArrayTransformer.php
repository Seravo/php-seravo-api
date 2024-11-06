<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Concerns;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait ArrayTransformer
{
    use ArrayRemoveNullValues;

    /**
     *
     * @return array<string, mixed>
     */
    public function toArray(mixed $input): array
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $serializer = new Serializer([$normalizer]);

        return $this->arrayFilterRecursive($serializer->normalize($input));
    }
}
