<?php

namespace Modules\Backend\Reaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Reaction\Dto\ViewBackendReactionDto;

final class ViewBackendReactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): ViewBackendReactionDto
    {
        return new ViewBackendReactionDto(
            $this->route('id'),
        );
    }
}
