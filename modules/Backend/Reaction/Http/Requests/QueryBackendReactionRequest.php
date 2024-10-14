<?php

namespace Modules\Backend\Reaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Reaction\Dto\QueryBackendReactionDto;

final class QueryBackendReactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): QueryBackendReactionDto
    {
        return new QueryBackendReactionDto(
            //
        );
    }
}
