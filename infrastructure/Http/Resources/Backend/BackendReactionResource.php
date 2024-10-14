<?php

namespace Infrastructure\Http\Resources\Backend;

use Infrastructure\Eloquent\Models\Post;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\Traits\ConvertsSchemaToArray;
use Infrastructure\Http\Schemas\Backend\BackendPostSchema;

/**
 * @property Post $resource
 */
final class BackendReactionResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): BackendPostSchema
    {
        return new BackendPostSchema(
            $this->resource->id,
            $this->resource->comment_id,
            $this->resource->reaction_type,
            $this->resource->reactions,
        );
    }
}
