<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use League\OAuth2\Client\Provider\AbstractProvider;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;
use Seravo\SeravoApi\Exceptions\AuthenticationException;
use Seravo\SeravoApi\Exceptions\MissingAccessTokenException;

class OpenIdConnectAuthProvider implements AuthProviderInterface
{
    private ?string $accessToken = null;

    private int $accessTokenExpiresAt = 0;

    public function __construct(
        private AbstractProvider $oidc
    ) {
    }

    public function getAccessToken(): string
    {
        if ($this->accessToken !== null && !$this->isAccessTokenExpired()) {
            return $this->accessToken;
        }

        try {
            $response = $this->oidc->getAccessToken('client_credentials', ['scope' => 'openid']);
        } catch (\Exception $e) {
            throw new AuthenticationException($e->getMessage(), $e->getCode(), $e);
        }

        $token = $response->getToken();

        if ($token === '') {
            throw new MissingAccessTokenException('Access token in response was empty');
        }

        $this->accessToken = $token;
        $expiresAt = $response->getExpires();
        // If expiry is provided and valid, use it. Otherwise treat as already expired to avoid caching.
        $this->accessTokenExpiresAt = is_int($expiresAt) && $expiresAt > 0 ? $expiresAt : time() - 1;

        return $this->accessToken;
    }

    private function isAccessTokenExpired(): bool
    {
        return $this->accessTokenExpiresAt <= time();
    }
}
