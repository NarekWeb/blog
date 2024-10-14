<?php

namespace Infrastructure\Http\Schemas\Backend;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="BackendCommentSchema", type="object")
 */
final class BackendCommentSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,
        /** @OA\Property() */
        public int $postId,
        /** @OA\Property() */
        public string $body,
        /** @OA\Property() */
        public ?int $likeCount,
        /** @OA\Property() */
        public ?int $dislikeCount,
        /** @OA\Property() */
        public string $createdAt,
    ) {
        //
    }
}
