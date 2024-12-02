<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum OrderStatusEnum: string
{
    case New = 'new';
    case Accepted = 'accepted';
    case Deployed = 'deployed';
    case Rejected = 'rejected';
}
