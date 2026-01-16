<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Formatter;

use Throwable;
use ReflectionClass;
use RuntimeException;
use Seravo\SeravoApi\Contracts\CollectionInterface;
use Seravo\SeravoApi\Contracts\ResponseMapperInterface;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

final class ResponseFormatter
{
    public function __construct(private ResponseMapperInterface $responseMapper)
    {
    }

    /**
     * @template T of SeravoResponseInterface|CollectionInterface
     * @param string $json
     * @param class-string<T> $responseClass
     * @return T
     */
    public function format(string $json, string $responseClass): CollectionInterface|SeravoResponseInterface
    {
        $reflectionClass = new ReflectionClass($responseClass);

        if (
            $reflectionClass->implementsInterface(SeravoResponseInterface::class) === false &&
            $reflectionClass->implementsInterface(CollectionInterface::class) === false
        ) {
            throw new RuntimeException(sprintf(
                'Class %s must implement %s or %s',
                $responseClass,
                SeravoResponseInterface::class,
                CollectionInterface::class
            ));
        }

        if ($reflectionClass->isInstantiable() === false) {
            throw new RuntimeException('Class ' . $responseClass . ' is not instantiable');
        }

        try {
            $decodedJson = json_decode($json, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Invalid JSON: ' . json_last_error_msg());
            }

            if (is_array($decodedJson) && array_key_exists('results', $decodedJson)) {
                // Response is a collection
                $result = $this->responseMapper->mapToCollection(
                    json_encode($decodedJson['results'], JSON_THROW_ON_ERROR),
                    $responseClass
                );
            } else {
                // Response is a single object
                $result = $this->responseMapper->mapToResponse($json, $responseClass);
            }
        } catch (Throwable $e) {
            throw new RuntimeException(
                'Failed to deserialize ' . $responseClass . ' object: ' . $e->getMessage()
            );
        }

        /** @var T $result */
        return $result;
    }
}
