<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum HttpMethod: string
{
    case Get = 'GET';
    case Post = 'POST';
    case Put = 'PUT';
}
