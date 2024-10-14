<?php

namespace Tests\Integration\Http\Backend\Comment;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Eloquent\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendCommentCreateRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[NoReturn] public function testCreateComment(): void
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

        $this->assertDatabaseCount('comments', 1);

        $this->assertDatabaseHas('comments', [
            'id' => $response['id'],
            'body' => $request['body'],
        ]);
    }
}
