<?php

namespace Infrastructure\Eloquent\Macros;

use Infrastructure\AbstractMacro;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

final class AddGlobalScope extends AbstractMacro
{
    protected function register(): void
    {
        Builder::macro('addGlobalScope', function (Scope $scope, bool $unique = true): Builder {
            return $this->withGlobalScope($unique ? uniqid($scope::class) : $scope::class, $scope);
        });
    }
}
