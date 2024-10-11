<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exception;

final class ValidationErrorException extends \Exception
{
    protected mixed $data;

    public function __construct(string $message, int $code, mixed $data)
    {
        $this->data = $data;
        parent::__construct($message, $code);
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
