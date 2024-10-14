<?php

namespace Modules\Backend\Reaction\Dto;

final class CreateBackendReactionDto
{
    public function __construct(
        public int $commentId,
        public string $reactionType,
        public int    $visitorId,

    ) {
        //
    }
}
