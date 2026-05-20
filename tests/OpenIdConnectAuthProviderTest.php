<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi;

use League\OAuth2\Client\Token\AccessTokenInterface;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use PHPUnit\Framework\TestCase;
use Stevenmaguire\OAuth2\Client\Provider\Keycloak;
use PHPUnit\Framework\MockObject\MockObject;
use Seravo\SeravoApi\OpenIdConnectAuthProvider;
use Seravo\SeravoApi\Exceptions\AuthenticationException;
use Seravo\SeravoApi\Exceptions\MissingAccessTokenException;

class OpenIdConnectAuthProviderTest extends TestCase
{
    private const ACCESS_TOKEN = 'access_token';

    private MockObject&Keycloak $oidcMock;

    protected function setUp(): void
    {
        $this->oidcMock = $this->createMock(Keycloak::class);
    }

    private function createAuthProvider(): OpenIdConnectAuthProvider
    {
        return new OpenIdConnectAuthProvider($this->oidcMock);
    }

    public function testAuthProviderCanBeInstantiatedSuccessfully(): void
    {
        $authProvider = $this->createAuthProvider();
        $this->assertInstanceOf(OpenIdConnectAuthProvider::class, $authProvider);
    }

    public function testGetAccessToken(): void
    {
        $accessTokenMock = $this->createMock(AccessTokenInterface::class);
        $accessTokenMock->expects($this->once())
            ->method('getToken')
            ->willReturn(self::ACCESS_TOKEN);
        $accessTokenMock->expects($this->once())
            ->method('getExpires')
            ->willReturn(time() + 3600);

        $this->oidcMock->expects($this->once())
            ->method('getAccessToken')
            ->with('client_credentials', ['scope' => 'openid'])
            ->willReturn($accessTokenMock);

        $authProvider = $this->createAuthProvider();

        $firstAccessToken = $authProvider->getAccessToken();
        $secondAccessToken = $authProvider->getAccessToken();

        $this->assertEquals(self::ACCESS_TOKEN, $firstAccessToken);
        // The second call intentionally exercises the cached path; the mock expectations
        // above verify that the underlying provider is only called once.
        $this->assertSame($firstAccessToken, $secondAccessToken);
    }

    public function testGetAccessTokenRefreshesWhenCachedTokenIsExpired(): void
    {
        $expiredAccessTokenMock = $this->createMock(AccessTokenInterface::class);
        $expiredAccessTokenMock->expects($this->once())
            ->method('getToken')
            ->willReturn('expired_token');
        $expiredAccessTokenMock->expects($this->once())
            ->method('getExpires')
            ->willReturn(time() - 60);

        $freshAccessTokenMock = $this->createMock(AccessTokenInterface::class);
        $freshAccessTokenMock->expects($this->once())
            ->method('getToken')
            ->willReturn(self::ACCESS_TOKEN);
        $freshAccessTokenMock->expects($this->once())
            ->method('getExpires')
            ->willReturn(time() + 3600);

        $this->oidcMock->expects($this->exactly(2))
            ->method('getAccessToken')
            ->with('client_credentials', ['scope' => 'openid'])
            ->willReturnOnConsecutiveCalls($expiredAccessTokenMock, $freshAccessTokenMock);

        $authProvider = $this->createAuthProvider();

        $this->assertEquals('expired_token', $authProvider->getAccessToken());
        $this->assertEquals(self::ACCESS_TOKEN, $authProvider->getAccessToken());
    }

    public function testGetAccessTokenDoesNotCacheWhenExpiryIsNull(): void
    {
        $accessTokenMock = $this->createMock(AccessTokenInterface::class);
        $accessTokenMock->expects($this->exactly(2))
            ->method('getToken')
            ->willReturn(self::ACCESS_TOKEN);
        $accessTokenMock->expects($this->exactly(2))
            ->method('getExpires')
            ->willReturn(null);

        $this->oidcMock->expects($this->exactly(2))
            ->method('getAccessToken')
            ->with('client_credentials', ['scope' => 'openid'])
            ->willReturn($accessTokenMock);

        $authProvider = $this->createAuthProvider();
        $this->assertEquals(self::ACCESS_TOKEN, $authProvider->getAccessToken());
        $this->assertEquals(self::ACCESS_TOKEN, $authProvider->getAccessToken());
    }

    public function testGetAccessTokenThrowsAuthenticationExceptionWhenTokenCanNotBeRequested(): void
    {
        $this->oidcMock->expects($this->once())
            ->method('getAccessToken')
            ->with('client_credentials', ['scope' => 'openid'])
            ->willThrowException($this->createMock(IdentityProviderException::class));

        $authProvider = $this->createAuthProvider();
        $this->expectException(AuthenticationException::class);
        $authProvider->getAccessToken();
    }

    public function testGetAccessTokenThrowsMissingAccessTokenExceptionWhenTokenIsEmpty(): void
    {
        $accessTokenMock = $this->createMock(AccessTokenInterface::class);
        $accessTokenMock->expects($this->once())
            ->method('getToken')
            ->willReturn('');

        $this->oidcMock->expects($this->once())
            ->method('getAccessToken')
            ->with('client_credentials', ['scope' => 'openid'])
            ->willReturn($accessTokenMock);

        $authProvider = $this->createAuthProvider();
        $this->expectException(MissingAccessTokenException::class);
        $authProvider->getAccessToken();
    }
}
