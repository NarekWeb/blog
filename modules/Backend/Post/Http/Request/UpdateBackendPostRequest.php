<?php

namespace Modules\Backend\Post\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Eloquent\Models\Post;
use Modules\Backend\Post\Dto\UpdateBackendPostDto;

final class UpdateBackendPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        $post =  Post::find($this->route('id'));

        return $post->visitor_id === $this->visitorId;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'nullable',
                'string',
            ],
            'content' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function toDto(): UpdateBackendPostDto
    {
        return new UpdateBackendPostDto(
            $this->route('id'),
            $this->input('title'),
            $this->input('content'),
        );
    }
}
