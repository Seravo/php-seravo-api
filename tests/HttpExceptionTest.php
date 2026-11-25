<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi;

use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\Exceptions\BadRequestException;
use Seravo\SeravoApi\Exceptions\HttpException;

class HttpExceptionTest extends TestCase
{
    public function testConstructorStoresMessageAndCode(): void
    {
        $exception = new HttpException('Something went wrong', 500, [], 'req-123');

        $this->assertSame('Something went wrong', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
    }

    public function testGetContextReturnsProvidedContext(): void
    {
        $context = [
            'errors' => ['name' => ['The name field is required.']],
            'meta' => ['attempt' => 2, 'nested' => ['flag' => true]],
        ];

        $exception = new HttpException('Validation failed', 422, $context, 'req-456');

        $this->assertSame($context, $exception->getContext());
    }

    public function testGetContextReturnsEmptyArrayWhenNoContextProvided(): void
    {
        $exception = new HttpException('Not found', 404, [], 'req-789');

        $this->assertSame([], $exception->getContext());
    }

    public function testGetRequestIdReturnsProvidedRequestId(): void
    {
        $exception = new HttpException('Server error', 500, [], 'abc-def-ghi');

        $this->assertSame('abc-def-ghi', $exception->getRequestId());
    }

    public function testGetRequestIdReturnsEmptyStringWhenEmpty(): void
    {
        $exception = new HttpException('Server error', 500, [], '');

        $this->assertSame('', $exception->getRequestId());
    }

    public function testSubclassesInheritContextAndRequestId(): void
    {
        $exception = new BadRequestException('Bad request', 400, ['field' => 'email'], 'req-400');

        $this->assertInstanceOf(HttpException::class, $exception);
        $this->assertSame(['field' => 'email'], $exception->getContext());
        $this->assertSame('req-400', $exception->getRequestId());
    }
}
