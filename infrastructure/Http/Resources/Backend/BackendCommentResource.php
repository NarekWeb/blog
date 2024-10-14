<?php

namespace Infrastructure\Http\Resources\Backend;

use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Eloquent\Models\Comment;
use Infrastructure\Http\Resources\Traits\ConvertsSchemaToArray;
use Infrastructure\Http\Schemas\Backend\BackendCommentSchema;

/**
 * @property Comment $resource
 */
final class BackendCommentResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): BackendCommentSchema
    {
        return new BackendCommentSchema(
            $this->resource->id,
            $this->resource->post_id,
            $this->resource->body,
            $this->resource->like_count,
            $this->resource->dislike_count,
            $this->resource->created_at->format('F j, Y, g:i a'),
        );
    }
}
