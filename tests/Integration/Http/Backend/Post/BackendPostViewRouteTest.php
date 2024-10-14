<?php

namespace Tests\Integration\Http\Backend\Post;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Eloquent\Models\Post;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendPostViewRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testNotFound(): void
    {
        $this
            ->json('GET', 'backend/post/111')
            ->assertNotFound();
    }

    public function testGetPost(): void
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
            ->json('GET', "backend/post/$post->id")
            ->assertOk();
    }
}
