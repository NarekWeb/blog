<?php

namespace Tests\Integration\Http\Backend\Comment;

use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\Eloquent\Models\Comment ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Eloquent\Models\Post;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendCommentDeleteRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testDeleteComment(): void
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

        $response = $this
            ->json('POST', 'backend/comment', $request)
            ->assertCreated();

        $comment = Comment::first();

        $this
            ->json('delete', "backend/comment/{$comment->id}")
            ->assertOk();
    }
}
