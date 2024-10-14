<?php

namespace Modules\Backend\Post\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\Post;
use Modules\Backend\Post\Dto\CreateBackendPostDto;
use Modules\Backend\Post\Dto\DeleteBackendPostDto;
use Modules\Backend\Post\Dto\UpdateBackendPostDto;

final class BackendPostCommandService
{
    public function create(CreateBackendPostDto $request): int
    {
        return DB::transaction(static function () use ($request): int {
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'visitor_id' => $request->visitorId,
            ]);

            Event::dispatch('backend.post.created', [$post->id]);

            return $post->id;
        });
    }

    public function update(UpdateBackendPostDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $post = Post::findOrFail($request->id);

            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            Event::dispatch('backend.post.updated', [$post->id]);
        });
    }

    public function delete(DeleteBackendPostDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $post = Post::findOrFail($request->id);
            $post->delete();

            Event::dispatch('backend.post.deleted', [$post->id]);
        });
    }
}
