<?php

namespace Modules\Backend\Post\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Backend\Post\Dto\ViewBackendPostDto;

final class ViewBackendPostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function toDto(): ViewBackendPostDto
    {
        return new ViewBackendPostDto(
            $this->route('id'),
        );
    }
}
