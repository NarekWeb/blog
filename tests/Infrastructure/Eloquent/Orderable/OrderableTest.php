<?php

namespace Tests\Infrastructure\Eloquent\Orderable;

use Mockery;
use Hamcrest\Matchers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Infrastructure\Eloquent\Orderable\Orderable;
use Infrastructure\Eloquent\Orderable\OrderableDriver;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class OrderableTest extends TestCase
{
    public function testOrderByDriverPublicMethods(): void
    {
        $model = new class() extends Model {
            use Orderable;

            public function getOrderableDriver(): OrderableDriver
            {
                $driver = Mockery::mock(new class() extends OrderableDriver {
                    public function first(): void
                    {
                        //
                    }

                    public function second(): void
                    {
                        //
                    }

                    protected function third(): void
                    {
                        //
                    }

                    private function fourth(): void
                    {
                        //
                    }
                });

                $driver
                    ->shouldReceive('first')
                    ->once()
                    ->withArgs([Matchers::anInstanceOf(Builder::class), 'ASC'])
                    ->andReturnNull();

                $driver
                    ->shouldReceive('second')
                    ->once()
                    ->withArgs([Matchers::anInstanceOf(Builder::class), 'DESC'])
                    ->andReturnNull();

                return $driver;
            }
        };

        $model->orderable([
            'first:ASC',
            'second:DESC',
            'third:ASC',
            'fourth:ASC',
        ]);
    }
}
