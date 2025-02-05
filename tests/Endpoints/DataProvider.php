<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use InvalidArgumentException;
use Seravo\SeravoApi\SeravoAPI as SeravoApiClient;
use Seravo\SeravoApi\HttpClient\Builder;

abstract class DataProvider implements DataProviderInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getData(mixed $param = null): array
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
        $function = str_replace('test', 'data', $backtrace['function']);
        if (method_exists($this, $function)) {
            if ($param !== null) {
                return $this->$function($param);
            }

            return $this->$function();
        }

        $folder = str_replace('data', '', str_replace('Seravo\Tests\SeravoApi\Data\\', '', strtolower(static::class)));
        $file = __DIR__ . '/MockData/' . $folder . '/' . $function . '.json';

        if (!file_exists($file)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Please specify either a data provider function %s::%s or add the json response for the test at %s',
                    $backtrace['class'] ?? 'unknown class',
                    $function,
                    $file
                )
            );
        }

        $fileContents = file_get_contents($file);
        if ($fileContents === false) {
            throw new InvalidArgumentException(sprintf('Unable to read the file at %s', $file));
        }

        return json_decode($fileContents, true);
    }

    /**
     * @param array<int, mixed>|null $requests
     */
    public function createClientHandler(?array $requests = [], ?MockHandler $mock = null): SeravoApiClient
    {
        $mock = new MockHandler($requests);
        return new SeravoApiClient(
            'test1234',
            'test1234',
            null,
            new Builder(new Client(['handler' => HandlerStack::create($mock)]))
        );
    }
}
