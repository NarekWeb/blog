<?php

namespace Modules\Backend\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Comment\Dto\CreateBackendCommentDto;

final class CreateBackendCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'postId' => [
                'required',
                'exists:posts,id',
            ],
            'body' => [
                'required',
                'string',
            ],
        ];
    }

    public function toDto(): CreateBackendCommentDto
    {
        return new CreateBackendCommentDto(
            $this->input('postId'),
            $this->input('body'),
            $this->input('visitorId'),
        );
    }
}
