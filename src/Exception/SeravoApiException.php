<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Exception;

use Seravo\SeravoApi\Enums\ApiEnvironment;

final class SeravoApiException extends \Exception
{
    public static function invalidEnvironment(string $environment): self
    {
        return new self(
            message: sprintf(
                'Invalid environment value %s. Allowed values are ',
                $environment
            ) . ApiEnvironment::values()
        );
    }
}
