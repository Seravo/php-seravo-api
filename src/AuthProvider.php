<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use InvalidArgumentException;
use Jumbojett\OpenIDConnectClient;

class AuthProvider
{
    private string $accessToken;

    private const TOKEN_ENDPOINT = 'https://idp.seravo.dev/realms/Seravo/protocol/openid-connect/token';

    public function __construct(string $clientId, string $secret)
    {
        $oidc = new OpenIDConnectClient('https://idp.seravo.dev', $clientId, $secret);
        $oidc->providerConfigParam(['token_endpoint' => self::TOKEN_ENDPOINT]);
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
