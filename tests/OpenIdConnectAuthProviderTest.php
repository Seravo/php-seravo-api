<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Tests;

use PHPUnit\Framework\TestCase;
use Jumbojett\OpenIDConnectClient;
use PHPUnit\Framework\MockObject\MockObject;
use Seravo\SeravoApi\OpenIdConnectAuthProvider;
use Seravo\SeravoApi\Exceptions\AuthenticationException;

class OpenIdConnectAuthProviderTest extends TestCase
{
    private const CLIENT_ID = 'client_id';
    private const SECRET = 'secret';
    private const PROVIDER_URL = 'https://provider.url';
    private const ACCESS_TOKEN = 'access_token';

    private MockObject&OpenIDConnectClient $oidcMock;

    protected function setUp(): void
    {
        $this->oidcMock = $this->createMock(OpenIDConnectClient::class);

        $this->oidcMock->expects($this->once())
            ->method('addScope')
            ->with(['openid']);
    }

    private function createAuthProvider(): OpenIdConnectAuthProvider
    {
        return new OpenIdConnectAuthProvider(
            self::CLIENT_ID,
            self::SECRET,
            self::PROVIDER_URL,
            $this->oidcMock
        );
    }

    public function testAuthProviderCanBeInstantiatedSuccesfully(): void
    {
        $authProvider = $this->createAuthProvider();
        $this->assertInstanceOf(OpenIdConnectAuthProvider::class, $authProvider);
    }

    public function testGetAccessToken(): void
    {
        $this->oidcMock->expects($this->once())
            ->method('requestClientCredentialsToken')
            ->willReturn((object)['access_token' => self::ACCESS_TOKEN]);

        $authProvider = $this->createAuthProvider();
        $this->assertEquals(self::ACCESS_TOKEN, $authProvider->getAccessToken());
    }

    public function testGetAccessTokenThrowsAuthenticationExceptionWhenTokenCanNotBeRequested(): void
    {
        $this->oidcMock->expects($this->once())
            ->method('requestClientCredentialsToken')
            ->willReturn(null);

        $authProvider = $this->createAuthProvider();
        $this->expectException(AuthenticationException::class);
        $authProvider->getAccessToken();
    }
}
