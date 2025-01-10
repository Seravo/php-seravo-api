<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;

class Authentication implements Plugin
{
    public function __construct(
        private readonly AuthProviderInterface $authProvider
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if (!$request->hasHeader('Authorization')) {
            $request = $request->withHeader('Authorization', "Bearer {$this->authProvider->getAccessToken()}");
        }

        return $next($request);
    }
}
