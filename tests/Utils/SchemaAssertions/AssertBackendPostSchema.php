<?php

namespace Tests\Utils\SchemaAssertions;

use Closure;
use Illuminate\Testing\TestResponse;
use Infrastructure\Eloquent\Models\Post;

final class AssertBackendPostSchema extends AssertSchema
{
    public function assert(): Closure
    {
        return function (Post $post, string $container = 'data'): TestResponse {
            return $this->response
                ->assertJsonPath("{$container}.id", $post->id)
                ->assertJsonPath("{$container}.content", $post->content)
                ->assertJsonPath("{$container}.title", $post->title);
        };
    }
}
