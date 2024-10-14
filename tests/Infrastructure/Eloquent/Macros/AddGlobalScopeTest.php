<?php

namespace Tests\Infrastructure\Eloquent\Macros;

use Mockery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class AddGlobalScopeTest extends TestCase
{
    private function generateCheckScope()
    {
        return new class() implements Scope {
            public function __construct(public ?Builder $instance = null)
            {
                //
            }

            public function extend(Builder $builder): void
            {
                $this->instance = $builder;
            }

            public function apply(Builder $builder, Model $model)
            {
                //
            }
        };
    }

    public function testIfScopeIsBindToTheBuilderUsingExtendMethod(): void
    {
        $scope = $this->generateCheckScope();
        $builder = new Builder(Mockery::mock(QueryBuilder::class));
        $builder->addGlobalScope($scope);

        $this->assertSame($builder, $scope->instance);
    }
}
