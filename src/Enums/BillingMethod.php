<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum BillingMethod: string
{
    case Paper = 'paper';
    case Email = 'email';
    case EInvoice = 'einvoice';
}
