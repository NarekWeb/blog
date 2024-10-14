<?php

namespace Tests\Integration\Http\Backend\Post;

use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\Eloquent\Models\Post ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendPostUpdateRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUpdateHomepageCategories(): void
    {
        $createData = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $this
            ->json('POST', 'backend/post', $createData)
            ->assertCreated();

        $post = Post::first();

        $updateData = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $this
            ->json('PUT', "backend/post/{$post->id}", $updateData)
            ->assertOk();
    }
}
