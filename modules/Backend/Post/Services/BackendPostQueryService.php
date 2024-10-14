<?php

namespace Modules\Backend\Post\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Eloquent\Models\Post;
use Modules\Backend\Post\Dto\ViewBackendPostDto;
use Modules\Backend\Post\Dto\QueryBackendPostDto;

final class BackendPostQueryService
{
    public function query(QueryBackendPostDto $request): Collection
    {
        return Post::query()->orderByDesc('created_at')->get();
    }

    public function view(ViewBackendPostDto $request):Model
    {
        return Post::with(['comments' => function ($query) {
            $query->withCount([
                'reactions as like_count' => function ($query) {
                    $query->where('reaction_type', 'like');
                },
                'reactions as dislike_count' => function ($query) {
                    $query->where('reaction_type', 'dislike');
                }
            ])->orderBy('created_at', 'desc');
        }])->findOrFail($request->id);
    }
}
