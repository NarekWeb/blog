<?php

namespace Modules\Backend\Reaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\Eloquent\Models\Reaction;
use Modules\Backend\Reaction\Dto\CreateBackendReactionDto;

final class CreateBackendReactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'commentId' => [
                'required',
                'exists:comments,id',
            ],
            'reactionType' => [
                'required',
                'string',
                'in:' . implode(',', Reaction::types()),
            ],
        ];
    }

    public function toDto(): CreateBackendReactionDto
    {
        return new CreateBackendReactionDto(
            $this->input('commentId'),
            $this->input('reactionType'),
            $this->input('visitorId'),
        );
    }
}
