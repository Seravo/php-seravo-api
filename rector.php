<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/examples',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        rectorPreset: true,
        codingStyle: true,
        privatization: true,
        phpunitCodeQuality: true
    )
    // uncomment to reach your current PHP version
    ->withPhpVersion(PhpVersion::PHP_84)
    ->withRules([ExplicitNullableParamTypeRector::class]);
