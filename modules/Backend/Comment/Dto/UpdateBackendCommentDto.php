<?php

namespace Modules\Backend\Comment\Dto;

final class UpdateBackendCommentDto
{
    public function __construct(
        public int    $id,
        public string $body,
    )
    {
        //
    }
}
