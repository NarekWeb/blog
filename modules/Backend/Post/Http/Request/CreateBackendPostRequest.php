<?php

namespace Modules\Backend\Post\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Post\Dto\CreateBackendPostDto;

final class CreateBackendPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
            ],
            'content' => [
                'required',
                'string',
            ],
        ];
    }

    public function toDto(): CreateBackendPostDto
    {
        return new CreateBackendPostDto(
            $this->input('title'),
            $this->input('content'),
            $this->input('visitorId'),
        );
    }
}
