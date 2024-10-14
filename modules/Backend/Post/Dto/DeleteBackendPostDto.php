<?php

namespace Modules\Backend\Post\Dto;

final class DeleteBackendPostDto
{
    public function __construct(
        public int $id,
    ) {
        //
    }
}
