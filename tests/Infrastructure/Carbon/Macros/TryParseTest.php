<?php

namespace Tests\Infrastructure\Carbon\Macros;

use stdClass;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class TryParseTest extends TestCase
{
    use WithFaker;

    public function testTryParseNullValue(): void
    {
        $this->assertNull(Carbon::tryParse(null));
    }

    public function testTryParseInvalidValue(): void
    {
        foreach ([
            $this,
            new stdClass(),
            $this->faker->uuid(),
            $this->faker->sha256(),
        ] as $value) {
            $this->assertNull(Carbon::tryParse($value));
        }
    }

    public function testTryParseDateTimeInterface(): void
    {
        $date = $this->faker->dateTimeThisCentury();

        $this->assertTrue(Carbon::tryParse($date)->eq($date));
    }

    public function testTryParseCarbonInstance(): void
    {
        $instance = Carbon::instance($this->faker->dateTimeThisCentury());

        $this->assertTrue(Carbon::tryParse($instance)->eq($instance));
    }

    public function testTryParseDateString(): void
    {
        $string = $this->faker->dateTimeThisCentury()->format('Y-m-d H:i:s');

        $this->assertSame(
            $string,
            Carbon::tryParse($string)->format('Y-m-d H:i:s')
        );
    }
}
