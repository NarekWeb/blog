<?php

namespace Modules\Backend\Post\Dto;

final class CreateBackendPostDto
{
    public function __construct(
        public string $title,
        public string $content,
        public string $visitorId,
    ) {
        //
    }
}
