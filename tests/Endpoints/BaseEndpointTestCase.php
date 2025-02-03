<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Error;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Seravo\SeravoApi\Contracts\CollectionInterface;
use Seravo\SeravoApi\Contracts\SeravoResponseInterface;

class BaseEndpointTestCase extends TestCase
{
    private DataProviderInterface $provider;

    public function __construct(string $name)
    {
        $this->initDataProvider();
        parent::__construct($name);
    }

    private function initDataProvider(): void
    {
        $class = str_replace(['Seravo\Tests\SeravoApi\Endpoints\\', 'Test', 'Endpoint'], '', get_class($this)) . 'Data';
        $full_path = '\Seravo\Tests\SeravoApi\Data\\' . $class;

        if (!is_subclass_of($full_path, DataProviderInterface::class)) {
            throw new RuntimeException('Class' . $full_path . ' must implement DataProviderInterface');
        }

        $this->provider = new $full_path();
    }

    protected function getDataProvider(): DataProviderInterface
    {
        return $this->provider;
    }

    /**
     * @param class-string $model
     * @param CollectionInterface $collection
     * @param array<string, mixed> $spec_data
     * @param string $key
     * @return void
     */
    protected function testCollection(
        string $model,
        CollectionInterface $collection,
        array $spec_data,
        string $key = 'id'
    ): void {
        $this->assertEquals(count($spec_data), count($collection->all()));
        foreach ($collection->all() as $response_object) {
            foreach ($spec_data as $object) {
                if ($object[$key] !== $response_object->toArray()[$key]) {
                    continue;
                }

                $this->testObject($model, $response_object, $object);
                break;
            }
        }
    }

    /**
     * @param class-string $model
     * @param SeravoResponseInterface $response_object
     * @param array<string, mixed> $spec_data
     * @return void
     */
    protected function testGetObject(string $model, SeravoResponseInterface $response_object, array $spec_data): void
    {
        $this->testObject($model, $response_object, $spec_data);
    }

    /**
     * @param class-string $model
     * @param SeravoResponseInterface $response_object
     * @param array<string, mixed> $spec_data
     * @return void
     */
    protected function testObject(string $model, SeravoResponseInterface $response_object, array $spec_data): void
    {
        $this->assertInstanceOf($model, $response_object);
        $array = $response_object->toArray();

        foreach ($array as $attr => $value) {
            if ($value === null && !array_key_exists($attr, $spec_data)) {
                continue;
            }

            $this->assertEquals($value, $spec_data[$attr], "Attribute {$attr} failed to meet comparison against spec.");
        }

        foreach (array_keys($spec_data) as $attr) {
            $this->assertTrue(
                array_key_exists($attr, $array),
                "Attribute {$attr} failed to exist in toArray of the response object."
            );
        }
    }
}
