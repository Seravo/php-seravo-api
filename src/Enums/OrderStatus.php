<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum OrderStatus: string
{
    case New = 'new';
    case Accepted = 'accepted';
    case Deployed = 'deployed';
    case Rejected = 'rejected';
}
