<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Contracts;

interface TokenVerifierInterface
{
    public function getPublicKey(string $filePath): string;

    public function verify(string $token): bool;
}
