<?php

namespace Modules\Backend\Reaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Reaction\Dto\DeleteBackendReactionDto;

final class DeleteBackendReactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): DeleteBackendReactionDto
    {
        return new DeleteBackendReactionDto(
            $this->route('id'),
        );
    }
}
