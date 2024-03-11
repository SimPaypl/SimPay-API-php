<?php

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::PHP_74);
    $rectorConfig->import(SetList::TYPE_DECLARATION);

    // Ensure file system caching is used instead of in-memory.
    $rectorConfig->cacheClass(FileCacheStorage::class);
    // Specify a path that works locally as well as on CI job runners.
    $rectorConfig->cacheDirectory('.cache/rector');
    
    // paths to refactor; solid alternative to CLI arguments
    $rectorConfig->paths([__DIR__ . '/src', __DIR__.'/tests', __DIR__.'/ecs.php', __DIR__.'/docs/examples']);
    
    $rectorConfig->skip([
        //temporary skip because throw error https://github.com/rectorphp/rector/issues/7480
        SimplifyBoolIdenticalTrueRector::class,
        FlipTypeControlToUseExclusiveTypeRector::class,
    ]);

    // register single rule
    $rectorConfig->rule(RemoveUnusedPrivatePropertyRector::class);

    // is your PHP version different from the one your refactor to? [default: your PHP version], uses PHP_VERSION_ID format
    $rectorConfig->phpVersion(PhpVersion::PHP_74);
    $rectorConfig->importShortClasses();
};
