<?php

namespace Tests\Integration\Http\Backend\Post;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Eloquent\Models\Visitor;
use JetBrains\PhpStorm\NoReturn;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class BackendPostCreateRouteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[NoReturn] public function testCreatePost(): void
    {
        $request = [
            'title' => $this->faker->title,
            'content' => $this->faker->text(),
        ];

        $response = $this
            ->json('POST', 'backend/post', $request)
            ->assertCreated();

        $this->assertDatabaseCount('posts', 1);

        $this->assertDatabaseHas('posts', [
            'id' => $response['id'],
            'title' => $request['title'],
            'content' => $request['content'],
        ]);
    }
}
