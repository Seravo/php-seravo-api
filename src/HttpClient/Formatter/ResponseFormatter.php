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
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

final class ResponseFormatter
{
    /**
     * A class-map to dynamically invoke the correct method based on the response type
     * @var array<string, string>
     */
    protected static $method = [
        'object' => 'mapToClassFromString',
        'array' => 'mapToClassArrayFromString',
    ];

    private static function init(): JsonMapperInterface
    {
        $factoryRegistry = FactoryRegistry::withNativePhpClassesAdded();
        $mapper = JsonMapperBuilder::new()
            ->withCaseConversionMiddleware(TextNotation::UNDERSCORE(), TextNotation::CAMEL_CASE())
            ->withDocBlockAnnotationsMiddleware()
            ->withNamespaceResolverMiddleware()
            ->withTypedPropertiesMiddleware()
            ->withObjectConstructorMiddleware($factoryRegistry)
            ->withPropertyMapper(new PropertyMapper($factoryRegistry))
            ->build();

        return $mapper;
    }

    /**
     *
     * @template T of SeravoResponseInterface
     * @param string $json
     * @param class-string<T> $responseClass
     * @return array<int, T>|T
     */
    public static function format(string $json, string $responseClass): array|SeravoResponseInterface
    {
        $reflectionClass = new ReflectionClass($responseClass);

        if ($reflectionClass->implementsInterface(SeravoResponseInterface::class) === false) {
            throw new RuntimeException('Class '  . $responseClass . ' must implement SeravoResponseInterface');
        }

        if ($reflectionClass->isInstantiable() === false) {
            throw new RuntimeException('Class ' . $responseClass . ' is not instantiable');
        }

        try {
            $responseType = gettype(json_decode($json));
            $result = self::init()->{self::$method[$responseType]}($json, $responseClass);
        } catch (Throwable $e) {
            throw new RuntimeException(
                'Failed to deserialize ' . $responseClass . ' object: ' . $e->getMessage()
            );
        }

        return $result;
    }
}
