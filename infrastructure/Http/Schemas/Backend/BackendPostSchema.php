<?php

namespace Infrastructure\Http\Schemas\Backend;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="BackendPostSchema", type="object")
 */
final class BackendPostSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,
        /** @OA\Property() */
        public string $title,
        /** @OA\Property() */
        public string $content,
        /** @OA\Property() */
        public string $createdAt,
        /** @OA\Property(type="array", @OA\Items(ref="#/components/schemas/BackendCommentSchema")) */
        public ?array $comments,
    ) {
        //
    }
}
