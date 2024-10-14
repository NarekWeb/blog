<?php

namespace Tests\Integration\Http\Backend\Post;

use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\Eloquent\Models\Post ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendPostQueryRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testGetPostsInCorrectOrder(): void
    {
        $createData = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $this
            ->json('POST', 'backend/post', $createData)
            ->assertCreated();

        $posts = Post::all();

        $this
            ->json('GET', 'backend/post')
            ->assertOk()
            ->assertBackendPostSchemaCollection($posts);
    }
}
