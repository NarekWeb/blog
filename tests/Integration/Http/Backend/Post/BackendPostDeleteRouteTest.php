<?php

namespace Tests\Integration\Http\Backend\Post;

use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\Eloquent\Models\Post ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendPostDeleteRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testDeletePost(): void
    {
        $request = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $this
            ->json('POST', 'backend/post', $request)
            ->assertCreated();

        $post = Post::first();

        $this
            ->json('delete', "backend/post/{$post->id}")
            ->assertOk();
    }
}
