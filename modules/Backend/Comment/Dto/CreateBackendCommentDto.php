<?php

namespace Modules\Backend\Comment\Dto;

final class CreateBackendCommentDto
{
    public function __construct(
        public int $postId,
        public string $body,
        public int $visitorId,
    ) {
        //
    }
}
