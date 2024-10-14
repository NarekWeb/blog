<?php

namespace Infrastructure\Eloquent\Orderable;

use ReflectionMethod;
use ReflectionObject;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;

final class OrderableRule implements Rule
{
    private Collection $allowed;

    public function __construct(
        string | Model $model,
    ) {
        $obj = is_string($model) ? new $model() : $model;
        $ref = new ReflectionObject($obj->getOrderableDriver());

        $this->allowed = collect($ref->getMethods(ReflectionMethod::IS_PUBLIC))->mapWithKeys(
            static fn (ReflectionMethod $m) => [$m->getName() => true]
        );
    }

    public function passes($attribute, $value): bool
    {
//        dd($attribute, $value, is_array($value));
        if (!is_array($value)) {
            return false;
        }

        foreach ($value as $val) {
            if (!is_string($val)) {
                return false;
            }

            $meta = explode(':', $val);

            if (count($meta) !== 2) {
                return false;
            }

            [$param, $direction] = $meta;

            if (!$this->allowed->has($param) || !in_array($direction, ['ASC', 'DESC'], true)) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return trans('validation.order', [
            'columns' => implode(', ', $this->allowed->keys()->all()),
        ]);
    }
}
