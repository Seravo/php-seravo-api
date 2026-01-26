<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum DomainType: string
{
    case Registration = 'registration';
    case Transfer = 'transfer';
    case CustomerManaged = 'customer_managed';
}
