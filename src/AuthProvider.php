<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use InvalidArgumentException;
use Jumbojett\OpenIDConnectClient;

class AuthProvider
{
    private string $accessToken;

    public function __construct(string $clientId, string $secret, string $providerUrl, string $tokenEndpoint)
    {
        $oidc = new OpenIDConnectClient($providerUrl, $clientId, $secret);
        $oidc->providerConfigParam(['token_endpoint' => $tokenEndpoint]);
        $oidc->addScope(['openid']);

        $clientCredentialsToken = $oidc->requestClientCredentialsToken()->access_token ?? null;

        // TODO: Check for valid JWT
        if (!$clientCredentialsToken) {
            throw new InvalidArgumentException('Invalid Access Token');
        }

        $this->accessToken = $clientCredentialsToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
