<?php

namespace Modules\Backend\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Comment\Dto\QueryBackendCommentDto;

final class QueryBackendCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): QueryBackendCommentDto
    {
        return new QueryBackendCommentDto(
            //
        );
    }
}
