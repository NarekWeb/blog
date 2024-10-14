<?php

namespace Infrastructure\Http\Resources\Backend;

use Infrastructure\Eloquent\Models\Post;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\Traits\ConvertsSchemaToArray;
use Infrastructure\Http\Schemas\Backend\BackendPostSchema;

/**
 * @property Post $resource
 */
final class BackendPostResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): BackendPostSchema
    {
        return new BackendPostSchema(
            $this->resource->id,
            $this->resource->title,
            $this->resource->content,
            $this->resource->created_at->format('F j, Y, g:i a'),
            BackendCommentResource::schemas($this->resource->comments),
        );
    }
}
