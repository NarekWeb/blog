<?php

namespace Tests\Utils\Scenario\Definitions;

use Generator;
use Tests\Utils\Scenario\Scenario;

trait WithUnauthenticatedScenario
{
    abstract public function unauthenticated(): Generator;

    final public function unauthenticatedProvider(): array
    {
        return Scenario::generate($this->unauthenticated());
    }

    /**
     * @dataProvider unauthenticatedProvider
     */
    final public function testUnauthenticated(Scenario $scenario): void
    {
        $scenario->assert($this);
    }
}
