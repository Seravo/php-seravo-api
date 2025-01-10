<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Contracts;

interface AuthProviderInterface
{
    public function getAccessToken(): string;
}
