<?php

namespace Infrastructure\Http\Schemas\Backend;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="BackendReactionSchema", type="object")
 */
final class BackendReactionSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,
        /** @OA\Property() */
        public int $commentId,
        /** @OA\Property() */
        public string $reactionType,
    ) {
        //
    }
}
