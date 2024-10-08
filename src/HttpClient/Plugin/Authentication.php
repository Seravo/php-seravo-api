<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Seravo\SeravoApi\OrderModule\AuthProvider;

class Authentication implements Plugin
{
    public function __construct(
        private readonly AuthProvider $authProvider
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
