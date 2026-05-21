<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exceptions;

class InvalidAccessTokenException extends \Exception
{
    public function __construct(
        string $message = 'Invalid Access Token',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
