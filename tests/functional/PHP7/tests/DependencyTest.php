<?php

namespace Tests\PhpAT\functional\PHP7\tests;

use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;

class DependencyTest extends ArchitectureTest
{
    public function testDirectDependency(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::havePathname('Dependency/Constructor.php'))
            ->andClassesThat(Selector::havePathname('Dependency/MethodParameter.php'))
            ->andClassesThat(Selector::havePathname('Dependency/MethodReturn.php'))
            ->andClassesThat(Selector::havePathname('Dependency/Instantiation.php'))
            ->andClassesThat(Selector::havePathname('Dependency/UnusedDeclaration.php'))
            ->andClassesThat(Selector::havePathname('Dependency/DocBlock.php'))
            ->shouldDependOn()
            ->classesThat(Selector::havePathname('SimpleClass.php'))
            //->andClassesThat(Selector::havePathname('Dependency/DependencyNamespaceSimpleClass.php'))
            ->build();
    }
}