<?php

namespace Tests\Integration\Http\Backend\Comment;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Eloquent\Models\Comment;
use Infrastructure\Eloquent\Models\Post;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendCommentViewRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testNotFound(): void
    {
        $this
            ->json('GET', 'backend/comment/111')
            ->assertNotFound();
    }

    public function testGetComment(): void
    {
        $request = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $response = $this
            ->json('POST', 'backend/post', $request)
            ->assertCreated();
        $post = Post::first();

        $request = [
            'postId' => $post->id,
            'body' => $this->faker->text(),
        ];

        $this
            ->json('POST', 'backend/comment', $request)
            ->assertCreated();

        $comment = Comment::first();

        $this
            ->json('GET', "backend/comment/$comment->id")
            ->assertOk();
    }
}
