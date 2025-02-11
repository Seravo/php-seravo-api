<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Jumbojett\OpenIDConnectClient;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;
use Seravo\SeravoApi\Exceptions\AuthenticationException;
use Seravo\SeravoApi\Exceptions\MissingAccessTokenException;

class OpenIdConnectAuthProvider implements AuthProviderInterface
{
    private string $accessToken;

    public function __construct(
        private readonly string $clientId,
        private readonly string $secret,
        private readonly string $providerUrl,
        private ?OpenIDConnectClient $oidc = null
    ) {
        $this->oidc = $oidc ?? new OpenIDConnectClient($this->providerUrl, $this->clientId, $this->secret);
        $this->oidc->addScope(['openid']);
    }

    public function getAccessToken(): string
    {
        try {
            if ($this->oidc === null) {
                throw new AuthenticationException('OpenID Connect Client is not initialized');
            }

            $tokenResponse = $this->oidc->requestClientCredentialsToken();

            if (!isset($tokenResponse->access_token)) {
                throw new MissingAccessTokenException('Access token not found in response');
            }

            $this->accessToken = $tokenResponse->access_token;
        } catch (\Throwable $th) {
            throw new AuthenticationException($th->getMessage());
        }

        return $this->accessToken;
    }
}
