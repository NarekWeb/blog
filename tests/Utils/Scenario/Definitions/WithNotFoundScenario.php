<?php

namespace Tests\Utils\Scenario\Definitions;

use Generator;
use Tests\Utils\Scenario\Scenario;

trait WithNotFoundScenario
{
    abstract public function notFound(): Generator;

    final public function notFoundProvider(): array
    {
        return Scenario::generate($this->notFound());
    }

    /**
     * @dataProvider notFoundProvider
     */
    final public function testNotFound(Scenario $scenario): void
    {
        $scenario->assert($this);
    }
}
