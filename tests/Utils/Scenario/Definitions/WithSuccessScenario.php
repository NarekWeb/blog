<?php

namespace Tests\Utils\Scenario\Definitions;

use Generator;
use Tests\Utils\Scenario\Scenario;

trait WithSuccessScenario
{
    abstract public function success(): Generator;

    final public function successProvider(): array
    {
        return Scenario::generate($this->success());
    }

    /**
     * @dataProvider successProvider
     */
    final public function testSuccess(Scenario $scenario): void
    {
        $scenario->assert($this);
    }
}
