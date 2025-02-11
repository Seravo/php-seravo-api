<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exceptions;

class HttpException extends \Exception
{
    /** @param array<string, mixed> $context */
    public function __construct(string $message, int $code, protected array $context)
    {
        $this->context = $context;
        parent::__construct($message, $code);
    }

    /** @return array<string, mixed> */
    public function getContext(): array
    {
        return $this->context;
    }
}
