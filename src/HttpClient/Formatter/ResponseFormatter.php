<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Formatter;

use Throwable;
use ReflectionClass;
use RuntimeException;
use JsonMapper\JsonMapperBuilder;
use JsonMapper\Enums\TextNotation;
use JsonMapper\JsonMapperInterface;
use JsonMapper\Handler\PropertyMapper;
use JsonMapper\Handler\FactoryRegistry;
use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Contracts\CollectionInterface;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

final class ResponseFormatter
{
    private static function init(): JsonMapperInterface
    {
        $factoryRegistry = FactoryRegistry::withNativePhpClassesAdded();

        return JsonMapperBuilder::new()
            ->withCaseConversionMiddleware(TextNotation::UNDERSCORE(), TextNotation::CAMEL_CASE())
            ->withDocBlockAnnotationsMiddleware()
            ->withNamespaceResolverMiddleware()
            ->withTypedPropertiesMiddleware()
            ->withObjectConstructorMiddleware($factoryRegistry)
            ->withPropertyMapper(new PropertyMapper($factoryRegistry))
            ->build();
    }

    /**
     * @template T of SeravoResponseInterface|CollectionInterface
     * @param class-string<T> $responseClass
     * @return T
     */
    public static function format(string $json, string $responseClass): CollectionInterface|SeravoResponseInterface
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
            $responseType = gettype(json_decode($json));
            if ($responseType === 'array') {
                $decodedJson = json_decode($json, true);
                $constructor = $reflectionClass->getConstructor();
                if ($constructor === null) {
                    throw new RuntimeException('Class ' . $responseClass . ' does not have a constructor.');
                }

                $reflectionParam = $constructor->getParameters()[0];
                $reflectionType = $reflectionParam->getType();

                if ($reflectionType instanceof \ReflectionNamedType) {
                    /** @var class-string */
                    $reflectionObj = $reflectionType->getName();
                } else {
                    throw new RuntimeException('Unable to determine the type of the parameter.');
                }


                /** @var CollectionInterface $collection */
                $collection = new $responseClass();

                $result = array_map(function (array $item) use ($collection, $reflectionObj): void {
                    $jsonItem = json_encode($item);

                    if ($jsonItem === false) {
                        throw new RuntimeException('Failed to encode item to JSON.');
                    }

                    $mappedObject = self::init()->mapToClassFromString($jsonItem, $reflectionObj);

                    if (!$mappedObject instanceof AbstractResponse) {
                        throw new RuntimeException('Mapped object is not an instance of AbstractResponse.');
                    }

                    $collection->add($mappedObject);
                }, $decodedJson);

                $result = $collection;
            } else {
                $result = self::init()->mapToClassFromString($json, $responseClass);
            }
        } catch (Throwable $throwable) {
            throw new RuntimeException(
                'Failed to deserialize ' . $responseClass . ' object: ' . $throwable->getMessage(),
                $throwable->getCode(),
                $throwable
            );
        }

        /** @var T $result */
        return $result;
    }
}
