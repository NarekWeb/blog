<?php

namespace Modules\Backend\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Eloquent\Models\Comment;
use Modules\Backend\Comment\Dto\DeleteBackendCommentDto;

final class DeleteBackendCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post =  Comment::find($this->route('id'));

        return $post->visitor_id === $this->visitorId;
    }
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): DeleteBackendCommentDto
    {
        return new DeleteBackendCommentDto(
            $this->route('id'),
        );
    }
}
