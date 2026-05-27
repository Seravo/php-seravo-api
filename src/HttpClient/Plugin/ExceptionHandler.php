<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Plugin;

use Http\Promise\Promise;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Seravo\SeravoApi\Exceptions\BadRequestException;
use Seravo\SeravoApi\Exceptions\HttpException;
use Seravo\SeravoApi\Exceptions\UnauthorizedException;
use Seravo\SeravoApi\Exceptions\ValidationErrorException;

class ExceptionHandler implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {

        return $next($request)->then(function (ResponseInterface $response): ResponseInterface {
            /* HTTP Exceptions */
            if ($response->getStatusCode() >= 400) {
                throw self::transformMessageToException($response);
            }

            return $response;
        });
    }

    /**
     * @param ResponseInterface $response
     * @return HttpException
     */
    private static function transformMessageToException(ResponseInterface $response): HttpException
    {
        $status = $response->getStatusCode();
        $message = $response->getReasonPhrase();
        $rawBody = $response->getBody()->getContents();
        $decodedContext = json_decode($rawBody, true);
        $context = is_array($decodedContext) ? $decodedContext : ['rawBody' => $rawBody];

        if (400 === $status) {
            return new BadRequestException($message, $status, $context);
        }

        if (403 === $status || 401 === $status) {
            return new UnauthorizedException($message, $status, $context);
        }

        if (422 === $status) {
            return new ValidationErrorException($message, $status, $context);
        }

        return new HttpException($message, $status, $context);
    }
}
