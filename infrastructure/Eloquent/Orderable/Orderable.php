<?php

namespace Infrastructure\Eloquent\Orderable;

use ReflectionObject;
use Illuminate\Database\Eloquent\Builder;

trait Orderable
{
    abstract public function getOrderableDriver(): OrderableDriver;

    final public function scopeOrderable(Builder $builder, ?array $params = null): void
    {
        if (!$params) {
            return;
        }

        $driver = $this->getOrderableDriver();
        $ref = new ReflectionObject($driver);

        foreach ($params as $param) {
            [$method, $direction] = explode(':', $param);

            if ($ref->hasMethod($method) && $ref->getMethod($method)->isPublic()) {
                $driver->{$method}($builder, $direction);
            }
        }
    }
}
