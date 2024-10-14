<?php

namespace Tests\Integration;

use Tests\Utils\Traits\WithMailFake;
use Tests\Utils\Traits\WithStorageFake;
use Tests\AbstractTestCase as BaseTestCase;
use Tests\Utils\Traits\WithNotificationFake;
use Tests\Utils\Traits\WithSchemaAssertions;
use Tests\Utils\Traits\WithCurrentTimestampFake;

abstract class AbstractIntegrationTestCase extends BaseTestCase
{
    use WithSchemaAssertions,
        WithMailFake,
        WithStorageFake,
        WithNotificationFake,
        WithCurrentTimestampFake;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpTestResponseMacros();
        $this->setUpMailFake();
        $this->setUpStorageFake();
        $this->setUpNotificationFake();
    }

    public function tearDown(): void
    {
        $this->tearDownTestResponseMacros();
        $this->tearDownMailFake();
        $this->tearDownStorageFake();
        $this->tearDownNotificationFake();

        parent::tearDown();
    }
}
