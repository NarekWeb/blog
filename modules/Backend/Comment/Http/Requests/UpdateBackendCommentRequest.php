<?php

namespace Modules\Backend\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Eloquent\Models\Comment;
use Infrastructure\Eloquent\Models\Post;
use Modules\Backend\Comment\Dto\UpdateBackendCommentDto;

final class UpdateBackendCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $comment = Comment::find($this->route('id'));

        return $comment->visitor_id === $this->visitorId;
    }

    public function rules(): array
    {
        return [
            'body' => [
                'required',
                'string',
            ],
        ];
    }

    public function toDto(): UpdateBackendCommentDto
    {
        return new UpdateBackendCommentDto(
            $this->route('id'),
            $this->input('body'),
        );
    }
}
