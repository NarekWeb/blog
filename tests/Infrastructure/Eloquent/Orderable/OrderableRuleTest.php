<?php

namespace Tests\Infrastructure\Eloquent\Orderable;

use DateTime;
use stdClass;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Eloquent\Orderable\Orderable;
use Infrastructure\Eloquent\Orderable\OrderableRule;
use Infrastructure\Eloquent\Orderable\OrderableDriver;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class OrderableRuleTest extends TestCase
{
    private function getRule(): OrderableRule
    {
        $model = new class() extends Model {
            use Orderable;

            public function getOrderableDriver(): OrderableDriver
            {
                return new class() extends OrderableDriver {
                    public function first(): void
                    {
                        //
                    }

                    public function second(): void
                    {
                        //
                    }
                };
            }
        };

        return new OrderableRule($model);
    }

    public function testFailsWithNonArrayValue(): void
    {
        $rule = $this->getRule();

        foreach ([
            '',
            1,
            new stdClass(),
            new DateTime(),
        ] as $val) {
            $this->assertFalse($rule->passes('attr', $val));
        }
    }

    public function testFailsWithNonStringArrayValue(): void
    {
        $rule = $this->getRule();

        foreach ([
            [1],
            [new stdClass()],
            [new DateTime()],
            [[]],
        ] as $val) {
            $this->assertFalse($rule->passes('attr', $val));
        }
    }

    public function testFailsWithInvalidStringArrayValue(): void
    {
        $rule = $this->getRule();

        foreach ([
            ['non valid'],
            ['invalid', 'also invalid'],
        ] as $val) {
            $this->assertFalse($rule->passes('attr', $val));
        }
    }

    public function testFailsWithInvalidParamValue(): void
    {
        $rule = $this->getRule();

        foreach ([
            ['invalid:DESC'],
            ['invalid:ASC'],
        ] as $val) {
            $this->assertFalse($rule->passes('attr', $val));
        }
    }

    public function testFailsWithInvalidDirectionValue(): void
    {
        $rule = $this->getRule();

        foreach ([
            ['first:invalid'],
            ['second:also invalid'],
        ] as $val) {
            $this->assertFalse($rule->passes('attr', $val));
        }
    }

    public function testPassesWithValidParamAndDirection(): void
    {
        $rule = $this->getRule();

        foreach ([
            ['first:ASC', 'first:DESC'],
            ['first:DESC', 'second:ASC'],
        ] as $val) {
            $this->assertTrue($rule->passes('attr', $val));
        }
    }


    public function testMessageIncludesAllowedParamsValue(): void
    {
        $rule = $this->getRule();
        $message = $rule->message();

        $this->assertStringContainsString('first', $message);
    }
}
