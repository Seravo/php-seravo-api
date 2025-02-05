<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php81\Rector\MethodCall\MyCLabsMethodCallToEnumConstRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/examples',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        MyCLabsMethodCallToEnumConstRector::class,
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
    ->withPhpSets(php84: true);
