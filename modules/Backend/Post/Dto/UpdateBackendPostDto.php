<?php

namespace Modules\Backend\Post\Dto;

final class UpdateBackendPostDto
{
    public function __construct(
        public int    $id,
        public string $title,
        public string $content,
    )
    {
        //
    }
}
