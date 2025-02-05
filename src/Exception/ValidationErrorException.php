<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exception;

final class ValidationErrorException extends \Exception
{
    public function __construct(string $message, int $code, private readonly mixed $data)
    {
        parent::__construct($message, $code);
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
