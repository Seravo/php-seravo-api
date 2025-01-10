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
        private readonly string $tokenEndpoint,
        private ?OpenIDConnectClient $oidc = null
    ) {
        $this->oidc = $oidc ?? new OpenIDConnectClient($this->providerUrl, $this->clientId, $this->secret);
        $this->oidc->providerConfigParam(['token_endpoint' => $this->tokenEndpoint]);
        $this->oidc->addScope(['openid']);
    }

    public function getAccessToken(): string
    {
        $tokenResponse = $this->oidc->requestClientCredentialsToken() ?? null;

        if (!$tokenResponse) {
            throw new InvalidAccessTokenException();
        }

        $this->accessToken = $tokenResponse->access_token;

        return $this->accessToken;
    }
}
