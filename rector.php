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
    // uncomment to reach your current PHP version
    ->withPhpSets(php84: true)
    ->withTypeCoverageLevel(100)
    ->withDeadCodeLevel(100)
    ->withCodeQualityLevel(0);
