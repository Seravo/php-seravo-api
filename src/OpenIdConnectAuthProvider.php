<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Jumbojett\OpenIDConnectClient;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;

class OpenIdConnectAuthProvider implements AuthProviderInterface
{
    private string $accessToken;

    public function __construct(string $clientId, string $secret, string $providerUrl, string $tokenEndpoint)
    {
        $oidc = new OpenIDConnectClient($providerUrl, $clientId, $secret);
        $oidc->providerConfigParam(['token_endpoint' => $tokenEndpoint]);
        $oidc->addScope(['openid']);

        $accessToken = $oidc->requestClientCredentialsToken()->access_token ?? null;

        if (!$accessToken) {
            throw new InvalidAccessTokenException();
        }

        $this->accessToken = $accessToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
