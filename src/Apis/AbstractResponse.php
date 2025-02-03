<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis;

use Symfony\Component\Serializer\Serializer;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

abstract readonly class AbstractResponse implements SeravoResponseInterface
{
    public const FORMAT_KEY = 'Y-m-d\TH:i:s';

    /**
     * Convert object recursively to array
    */
    public function toArray(): array
    {
        $normalizers = [
            new DateTimeNormalizer(
                [
                DateTimeNormalizer::FORMAT_KEY => self::FORMAT_KEY]
            ),
            new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())
        ];

        $serializer = new Serializer($normalizers);

        $array = (array) $serializer->normalize($this);

        return $array;
    }
}
