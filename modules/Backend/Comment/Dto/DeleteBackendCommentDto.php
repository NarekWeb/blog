<?php

namespace Modules\Backend\Comment\Dto;

final class DeleteBackendCommentDto
{
    public function __construct(
        public int $id,
    ) {
        //
    }
}
