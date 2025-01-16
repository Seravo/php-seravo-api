<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum ApiEndpoint: string
{
    case Orders = 'orders';
    case Prices = 'prices';
    case Products = 'products';
    case Plans = 'plans';
    case Promotions = 'promotions';
    case Affiliates = 'affiliates';
    case ProductGroups = 'product-groups';
}
