<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Plugin;

use Http\Promise\Promise;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;
use Seravo\SeravoApi\Contracts\TokenVerifierInterface;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;

class TokenVerifier implements Plugin
{
    public function __construct(
        private readonly TokenVerifierInterface $tokenVerifier,
        private readonly AuthProviderInterface $authProvider
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        try {
            $this->tokenVerifier->verify($this->authProvider->getAccessToken());
        } catch (InvalidAccessTokenException $e) {
            throw new InvalidAccessTokenException($e->getMessage());
        }

        return $next($request);
    }
}
