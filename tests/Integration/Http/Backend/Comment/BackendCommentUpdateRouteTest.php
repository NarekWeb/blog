<?php

namespace Tests\Integration\Http\Backend\Comment;

use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\Eloquent\Models\Comment ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Eloquent\Models\Post;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendCommentUpdateRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUpdateHomepageCategories(): void
    {
        $request = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $this
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

        $updateData = [
            'body' => $this->faker->text(),
        ];

        $this
            ->json('PUT', "backend/comment/{$comment->id}", $updateData)
            ->assertOk();
    }
}
