<?php

return Rector\Config\RectorConfig::configure()
    ->withPaths([__DIR__ . '/src', __DIR__ . '/tests', __DIR__ . '/examples'])
    ->withPhpVersion(Rector\ValueObject\PhpVersion::PHP_84)
    ->withRules([
         Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector::class,
    ]);
