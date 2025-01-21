<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Jumbojett\OpenIDConnectClient;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;
use Seravo\SeravoApi\Contracts\AuthProviderInterface;
use Seravo\SeravoApi\Exception\AuthenticationException;
use Seravo\SeravoApi\Exception\MissingAccessTokenException;

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
