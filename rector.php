<?php

declare(strict_types=1);

use App\Validator\Constraints\RoleNames;
use App\Validator\Constraints\UriSameOrigin;
use Rector\Caching\ValueObject\Storage\MemoryCacheStorage;
use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php80\Rector\FuncCall\ClassOnObjectRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Php80\Rector\Switch_\ChangeSwitchToMatchRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Symfony\Set\SensiolabsSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);
    $rectorConfig->skip([
        __DIR__.'/src/PayseraPagination',
        ClassPropertyAssignToConstructorPromotionRector::class => [
            __DIR__.'/src/Entity',
        ],
    ]);
    // $rectorConfig->phpstanConfig(__DIR__.'/rector-phpstan.neon.dist');
    $rectorConfig->symfonyContainerXml(__DIR__.'/var/cache/test/App_KernelTestDebugContainer.xml');
    $rectorConfig->disableImportShortClasses();

    // Read only property
    $rectorConfig->rule(ReadOnlyPropertyRector::class);
};
