<?php

namespace Tests\Utils\SchemaAssertions;

use Closure;
use Illuminate\Testing\TestResponse;
use Infrastructure\Eloquent\Models\Comment;

final class AssertBackendCommentSchema extends AssertSchema
{
    public function assert(): Closure
    {
        return function (Comment $comment, string $container = 'data'): TestResponse {
            return $this->response
                ->assertJsonPath("{$container}.id", $comment->id)
                ->assertJsonPath("{$container}.body", $comment->body);
        };
    }
}
