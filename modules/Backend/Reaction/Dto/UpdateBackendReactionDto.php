<?php

namespace Modules\Backend\Reaction\Dto;

final class UpdateBackendReactionDto
{
    public function __construct(
        public int    $id,
        public string $reactionType,
        public int    $visitorId,
    )
    {
        //
    }
}
