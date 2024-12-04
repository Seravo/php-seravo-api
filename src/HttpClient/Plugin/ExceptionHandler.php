<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Seravo\SeravoApi\Exception\AuthenticationException;
use Seravo\SeravoApi\Exception\ValidationErrorException;

class ExceptionHandler implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response): ResponseInterface {
            /* HTTP Exceptions */
            if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
                throw self::transformMessageToException($response);
            }

            return $response;
        });
    }

    /**
     * @param ResponseInterface $response
     * @return AuthenticationException|ValidationErrorException|RuntimeException
     */
    private static function transformMessageToException(ResponseInterface $response)
    {
        $status = $response->getStatusCode();
        $message = $response->getReasonPhrase();

        if (400 === $status) {
            return new RuntimeException($message, $status);
        }

        if (403 === $status || 401 === $status) {
            return new AuthenticationException($message, $status);
        }

        if (422 === $status) {
            return new ValidationErrorException($message, $status, $response->getBody()->__toString());
        }

        return new RuntimeException($message, $status);
    }
}
