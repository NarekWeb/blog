<?php

namespace Modules\Backend\Comment\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\Comment;
use Modules\Backend\Comment\Dto\CreateBackendCommentDto;
use Modules\Backend\Comment\Dto\DeleteBackendCommentDto;
use Modules\Backend\Comment\Dto\UpdateBackendCommentDto;

final class BackendCommentCommandService
{
    public function create(CreateBackendCommentDto $request): int
    {
        return DB::transaction(static function () use ($request): int {
            $comment = Comment::create([
                'post_id' => $request->postId,
                'body' => $request->body,
                'visitor_id' => $request->visitorId,
            ]);

            Event::dispatch('backend.comment.created', [$comment->id]);

            return $comment->id;
        });
    }

    public function update(UpdateBackendCommentDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $comment = Comment::findOrFail($request->id);

            $comment->update([
                'body' => $request->body,
            ]);

            Event::dispatch('backend.comment.updated', [$comment->id]);
        });
    }

    public function delete(DeleteBackendCommentDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $comment = Comment::findOrFail($request->id);
            $comment->delete();

            Event::dispatch('backend.comment.deleted', [$comment->id]);
        });
    }
}
