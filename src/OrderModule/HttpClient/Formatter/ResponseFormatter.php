<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\HttpClient\Formatter;

use Psr\Http\Message\ResponseInterface;
use Seravo\SeravoApi\OrderModule\Exception\InvalidApiResponseException;

final class ResponseFormatter
{
    public static function format(ResponseInterface $response): mixed
    {
        $result = json_decode((string) $response->getBody(), true);

        if ($result === null) {
            throw new InvalidApiResponseException('Error decoding JSON response from API');
        }

        return $result;
    }
}
