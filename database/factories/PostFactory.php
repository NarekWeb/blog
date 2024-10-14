<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'visitor_id' => 1,
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];
    }
}
