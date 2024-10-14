<?php

namespace Tests\Utils\Scenario\Definitions;

use Generator;
use Tests\Utils\Scenario\Scenario;

trait WithForbiddenScenario
{
    abstract public function forbidden(): Generator;

    final public function forbiddenProvider(): array
    {
        return Scenario::generate($this->forbidden());
    }

    /**
     * @dataProvider forbiddenProvider
     */
    final public function testForbidden(Scenario $scenario): void
    {
        $scenario->assert($this);
    }
}
