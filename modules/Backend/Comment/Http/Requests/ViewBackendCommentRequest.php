<?php

namespace Modules\Backend\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Comment\Dto\ViewBackendCommentDto;

final class ViewBackendCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): ViewBackendCommentDto
    {
        return new ViewBackendCommentDto(
            $this->route('id'),
        );
    }
}
