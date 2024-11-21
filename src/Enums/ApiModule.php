<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum ApiModule: string
{
    case Order = 'order';
    case Public = 'public';
}
