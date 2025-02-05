<?php

declare(strict_types=1);

namespace Seravo\SeravoApi;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use LogicException;
use stdClass;
use UnexpectedValueException;
use Seravo\SeravoApi\Contracts\TokenVerifierInterface;
use Seravo\SeravoApi\Exception\InvalidAccessTokenException;

class JwtVerifier implements TokenVerifierInterface
{
    private const JWT_ALGORITHM = 'RS256';

    public function __construct(
        private readonly EnvironmentManager $environmentManager
    ) {
    }

    /**
     * Get the public key from the file
     *
     * @param string $filePath
     * @return string
     */
    public function getPublicKey(string $filePath): string
    {
        $key = file_get_contents($filePath);

        if ($key === false) {
            throw new \RuntimeException('Unable to read public key file.');
        }

        return $key;
    }

    /**
     * Verify the JWT token
     *
     * @param string $jwt
     * @return boolean
     */
    public function verify(string $jwt): bool
    {
        try {
            $environment = $this->environmentManager->getEnvironment();
            $filePath = __DIR__ . '/../keys/idp-' . $environment->value . '.pub';

            $token = $this->decodeToken($jwt, $filePath);

            if (!$this->validateIssuer($token->iss)) {
                throw new InvalidAccessTokenException('Invalid issuer');
            }

            return true;
        } catch (LogicException $e) {
            // errors having to do with environmental setup or malformed JWT Keys
            throw new InvalidAccessTokenException($e->getMessage());
        } catch (UnexpectedValueException $e) {
            // errors having to do with JWT signature and claims
            throw new InvalidAccessTokenException($e->getMessage());
        }
    }

    /**
     * Decode the JWT token
     *
     * @param string $jwt
     * @param string $filePath
     * @return stdClass
     */
    protected function decodeToken(string $jwt, string $filePath): stdClass
    {
        /**
         * NOTE: The leeway is used when there is a clock skew times between the signing and verifying server.
         * By adding the leeway manually below, a rare edge case where the iat claim is set in the future
         * and decode method throws BeforeValidException can be covered.
         *
         * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
         */
        JWT::$leeway = 5; // $leeway in seconds
        return JWT::decode($jwt, new Key($this->getPublicKey($filePath), self::JWT_ALGORITHM));
    }

    /**
     * Validate the issuer
     *
     * @param string $issuer
     * @return boolean
     */
    protected function validateIssuer(string $issuer): bool
    {
        return $issuer === $this->environmentManager->getIdpUrl();
    }
}
