<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exception;

class InvalidAccessTokenException extends \Exception
{
    protected $message = 'Invalid Access Token';
}
