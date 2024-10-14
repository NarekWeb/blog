<?php

namespace Tests\Utils\Scenario;

use Closure;
use Generator;
use Illuminate\Support\Arr;

final class Scenario
{
    public function __construct(
        private readonly Closure $case,
        private readonly Closure $assertion,
    ) {
        //
    }

    public static function generate(Generator $definition): array
    {
        $cases = [];

        foreach ($definition as $name => $case) {
            if (is_string($case)) {
                $cases[$case] = fn () => [];
            } else {
                $cases[$name] = $case;
            }
        }

        $assertion = $definition->getReturn();

        return array_map(static fn (Closure $case) => [new static($case, $assertion)], $cases);
    }

    public function assert(object $bind): void
    {
        $this->assertion->call($bind, ...Arr::wrap($this->case->call($bind)));
    }
}
