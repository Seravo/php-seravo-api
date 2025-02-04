<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Jumbojett\OpenIDConnectClient;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;

class OpenIdConnectAuthProvider implements AuthProviderInterface
{
    private string $accessToken;

    public function __construct(
        private readonly string $clientId,
        private readonly string $secret,
        private readonly string $providerUrl,
    ) {
        try {
            $oidc = new OpenIDConnectClient($this->providerUrl, $this->clientId, $this->secret);
            $oidc->addScope(['openid']);

            $accessToken = $oidc->requestClientCredentialsToken()->access_token ?? null;

            if (!$accessToken) {
                throw new InvalidAccessTokenException('Invalid access token');
            }

            $this->accessToken = $accessToken;
        } catch (InvalidAccessTokenException $e) {
            throw new InvalidAccessTokenException($e->getMessage());
        }
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
