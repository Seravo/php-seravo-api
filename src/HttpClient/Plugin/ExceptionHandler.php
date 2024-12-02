<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Plugin;


use Seravo\SeravoApi\Exception\AuthenticationException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class ExceptionHandler implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response): ResponseInterface {
            $status = $response->getStatusCode();

            /* HTTP Exceptions */
            if ($status >= 400 && $status < 500) {
                throw self::transformMessageToException($status, $response->getReasonPhrase());
            }

            return $response;
        });
    }

    /**
     * @param int $status
     * @param string|null $message
     * @return AuthenticationException|RuntimeException
     */
    private static function transformMessageToException(int $status, ?string $message)
    {
        if (400 === $status) {
            return new RuntimeException($message, $status);
        }

        if (403 === $status || 401 === $status) {
            return new AuthenticationException($message, $status);
        }

        // TODO: Validation Errors (422)

        return new RuntimeException($message, $status);
    }
}
