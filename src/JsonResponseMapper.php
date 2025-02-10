<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use ReflectionClass;
use RuntimeException;
use JsonMapper\JsonMapperBuilder;
use JsonMapper\Enums\TextNotation;
use JsonMapper\JsonMapperInterface;
use JsonMapper\Handler\PropertyMapper;
use JsonMapper\Handler\FactoryRegistry;
use Seravo\SeravoApi\Apis\AbstractResponse;
use Seravo\SeravoApi\Contracts\CollectionInterface;
use Seravo\SeravoApi\Contracts\ResponseMapperInterface;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

class JsonResponseMapper implements ResponseMapperInterface
{
    private JsonMapperInterface $mapper;

    public function __construct()
    {
        $this->mapper = $this->init();
    }

    private function init(): JsonMapperInterface
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
     * @template T of CollectionInterface
     * @param string $json
     * @param class-string<T> $responseClass
     */
    public function mapToCollection(string $json, string $responseClass): CollectionInterface
    {
        $reflectionClass = new ReflectionClass($responseClass);
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

        $result = array_map(function (array $item) use ($collection, $reflectionObj) {
            $jsonItem = json_encode($item);

            if ($jsonItem === false) {
                throw new RuntimeException('Failed to encode item to JSON.');
            }

            $mappedObject = $this->mapper->mapToClassFromString($jsonItem, $reflectionObj);

            if (!$mappedObject instanceof AbstractResponse) {
                throw new RuntimeException('Mapped object is not an instance of AbstractResponse.');
            }

            $collection->add($mappedObject);
        }, $decodedJson);

        $result = $collection;

        return $result;
    }

    /**
     * @template T of SeravoResponseInterface
     * @param string $json
     * @param class-string<T> $responseClass
     */
    public function mapToResponse(string $json, string $responseClass): SeravoResponseInterface
    {
        return $this->mapper->mapToClassFromString($json, $responseClass);
    }
}
