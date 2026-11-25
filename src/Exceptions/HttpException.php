<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exceptions;

class HttpException extends \Exception
{
    /** @param array<string, mixed> $context */
    public function __construct(string $message, int $code, protected array $context, protected string $request_id)
    {
        $this->context = $context;
        $this->request_id = $request_id;
        parent::__construct($message, $code);
    }

    /** @return array<string, mixed> */
    public function getContext(): array
    {
        return $this->context;
    }

    /** Returns the x-seravo-request-id header value */
    public function getRequestId(): string
    {
        return $this->request_id;
    }
}
