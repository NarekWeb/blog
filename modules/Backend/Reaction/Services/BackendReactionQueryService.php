<?php

namespace Modules\Backend\Reaction\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Reaction;
use Modules\Backend\Reaction\Dto\ViewBackendReactionDto;
use Modules\Backend\Reaction\Dto\QueryBackendReactionDto;

final class BackendReactionQueryService
{
    public function query(QueryBackendReactionDto $request): Collection
    {
        return Reaction::query()->orderBy('id')->get();
    }

    public function view(ViewBackendReactionDto $request): Reaction
    {
        return Reaction::findOrFail($request->id);
    }
}
