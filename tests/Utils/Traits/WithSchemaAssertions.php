<?php

namespace Tests\Utils\Traits;

use Tests\Utils\SchemaAssertions\Finder;

trait WithSchemaAssertions
{
    private function setUpTestResponseMacros(): void
    {
        foreach (Finder::locate() as $assertion) {
            $assertion::bind();
        }
    }

    private function tearDownTestResponseMacros(): void
    {
        //
    }
}
