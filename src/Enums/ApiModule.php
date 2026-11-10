<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum ApiModule: string
{
    case Order = 'order/v1';
    case Public = 'public/v1';
    case Swd = 'swd/v1';
}
