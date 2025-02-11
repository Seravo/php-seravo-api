<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exceptions;

class InvalidAccessTokenException extends \Exception
{
    protected $message = 'Invalid Access Token';
}
