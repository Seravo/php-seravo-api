<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Enums;

enum ApiEnvironment: string
{
    case Production = 'production';
    case Staging = 'staging';
    case Testing = 'testing';

    public static function values(): string
    {
        return implode(', ', array_map(fn (self $enum) => $enum->value, self::cases()));
    }

    /**
     * @return array<int, string>
     */
    public static function asArray(): array
    {
        return array_map(fn (self $enum) => $enum->value, self::cases());
    }
}
