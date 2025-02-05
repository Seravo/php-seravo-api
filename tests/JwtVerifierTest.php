<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi;

use LogicException;
use PHPUnit\Framework\TestCase;
use Seravo\SeravoApi\JwtVerifier;
use Seravo\SeravoApi\EnvironmentManager;
use Seravo\SeravoApi\Enums\ApiEnvironment;
use PHPUnit\Framework\MockObject\MockObject;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;

final class JwtVerifierTest extends TestCase
{
    private MockObject&JwtVerifier $jwtVerifierMock;

    protected function setUp(): void
    {
        $environmentManagerMock = $this->getMockBuilder(EnvironmentManager::class)
            ->setConstructorArgs([ApiEnvironment::Testing->value])
            ->getMock();

        $this->jwtVerifierMock = $this->getMockBuilder(JwtVerifier::class)
            ->setConstructorArgs([$environmentManagerMock])
            ->getMock();
    }

    public function testPublicKeyCanBeReadSuccesfully(): void
    {
        $str = <<<END_WRAP
            -----BEGIN PUBLIC KEY-----
            my very random string
            -----END PUBLIC KEY-----
        END_WRAP;

        $this->jwtVerifierMock
            ->method('getPublicKey')
            ->with('/path/to/public_key')
            ->willReturn($str);

        $response = $this->jwtVerifierMock->getPublicKey('/path/to/public_key');

        $this->assertSame($str, $response);
    }

    public function testGetPublicKeyMethodThrowsRuntimeExceptionWhenUnableToReadPublicKey(): void
    {
        $this->jwtVerifierMock
            ->method('getPublicKey')
            ->with('/path/to/public_key')
            ->willThrowException(new \RuntimeException('Unable to read public key file.'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unable to read public key file.');

        $this->jwtVerifierMock->getPublicKey('/path/to/public_key');
    }

    public function testVerifyMethodReturnsTrueWhenAccessTokenIsValid(): void
    {
        $decodedToken = (object) ['iss' => 'valid-issuer'];
        $validJwt = 'your-valid-jwt-token-here';

        $environmentManagerMock = $this->createMock(EnvironmentManager::class);
        $environmentManagerMock->method('getEnvironment')
            ->willReturn(ApiEnvironment::Production);

        $jwtVerifierMock = $this->getMockBuilder(JwtVerifier::class)
            ->setConstructorArgs([$environmentManagerMock])
            ->onlyMethods(['getPublicKey', 'decodeToken', 'validateIssuer'])
            ->getMock();

        $jwtVerifierMock->method('getPublicKey')
            ->willReturn('your-public-key-here');

        $jwtVerifierMock->method('decodeToken')
            ->willReturn($decodedToken);

        $jwtVerifierMock->method('validateIssuer')
            ->with('valid-issuer')
            ->willReturn(true);

        $this->assertTrue($jwtVerifierMock->verify($validJwt));
    }

    public function testVerifyMethodThrowsInvalidAccessTokenExceptionWhenAccessTokenIssuerIsInvalid(): void
    {
        $decodedToken = (object) ['iss' => 'invalid-issuer'];
        $invalidJwt = 'your-invalid-jwt-token-here';

        $environmentManagerMock = $this->createMock(EnvironmentManager::class);
        $environmentManagerMock->method('getEnvironment')
            ->willReturn(ApiEnvironment::Production);

        $jwtVerifierMock = $this->getMockBuilder(JwtVerifier::class)
            ->setConstructorArgs([$environmentManagerMock])
            ->onlyMethods(['getPublicKey', 'decodeToken'])
            ->getMock();

        $jwtVerifierMock->method('getPublicKey')
            ->willReturn('your-public-key-here');


        $jwtVerifierMock->method('decodeToken')
            ->willReturn($decodedToken);

        $this->expectException(InvalidAccessTokenException::class);
        $this->expectExceptionMessage('Invalid issuer');

        $jwtVerifierMock->verify($invalidJwt);
    }

    public function testVerifyMethodThrowsInvalidAccessTokenExceptionWhenMalformedAccessTokenIsProvided(): void
    {
        $decodedToken = (object) ['iss' => 'invalid-issuer'];
        $jwt = 'your-invalid-jwt-token-here';

        $environmentManagerMock = $this->createMock(EnvironmentManager::class);
        $environmentManagerMock->method('getEnvironment')
            ->willReturn(ApiEnvironment::Production);

        $jwtVerifierMock = $this->getMockBuilder(JwtVerifier::class)
            ->setConstructorArgs([$environmentManagerMock])
            ->onlyMethods(['getPublicKey', 'validateIssuer', 'decodeToken'])
            ->getMock();

        $jwtVerifierMock->method('getPublicKey')
            ->willReturn('your-public-key-here');

        $jwtVerifierMock->method('validateIssuer')
            ->with($decodedToken->iss)
            ->willReturn(true);

        $jwtVerifierMock->method('decodeToken')
            ->with($jwt)
            ->willThrowException(new LogicException('Signature verification failed'));

        $this->expectException(InvalidAccessTokenException::class);
        $this->expectExceptionMessage('Signature verification failed');

        $jwtVerifierMock->verify($jwt);
    }
}
