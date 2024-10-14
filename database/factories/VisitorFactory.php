<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class VisitorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => hash('sha256', 'test'),
        ];
    }
}
