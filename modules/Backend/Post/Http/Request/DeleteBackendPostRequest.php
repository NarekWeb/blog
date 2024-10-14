<?php

namespace Modules\Backend\Post\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Eloquent\Models\Post;
use Modules\Backend\Post\Dto\DeleteBackendPostDto;

final class DeleteBackendPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post = Post::find($this->route('id'));

        return $post->visitor_id === $this->visitorId;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): DeleteBackendPostDto
    {
        return new DeleteBackendPostDto(
            $this->route('id'),
        );
    }
}
