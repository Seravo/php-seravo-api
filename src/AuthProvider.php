<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Jumbojett\OpenIDConnectClient;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;

class AuthProvider
{
    private string $accessToken;

    public function __construct(string $clientId, string $secret, string $providerUrl, string $tokenEndpoint)
    {
        $oidc = new OpenIDConnectClient($providerUrl, $clientId, $secret);
        $oidc->providerConfigParam(['token_endpoint' => $tokenEndpoint]);
        $oidc->addScope(['openid']);

        $clientCredentialsToken = $oidc->requestClientCredentialsToken()->access_token ?? null;

        if (!$clientCredentialsToken) {
            throw new InvalidAccessTokenException();
        }

        $this->accessToken = $clientCredentialsToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
