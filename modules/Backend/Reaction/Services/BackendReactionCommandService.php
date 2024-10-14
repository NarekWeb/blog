<?php

namespace Modules\Backend\Reaction\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Infrastructure\Eloquent\Models\Reaction;
use Modules\Backend\Reaction\Dto\CreateBackendReactionDto;
use Modules\Backend\Reaction\Dto\DeleteBackendReactionDto;

final class BackendReactionCommandService
{
    public function create(CreateBackendReactionDto $request): int
    {
        return DB::transaction(static function () use ($request): int {
            $reaction  = Reaction::where('comment_id',$request->commentId)
                ->where('visitor_id',$request->visitorId)->first();

            if ($reaction && $reaction->reaction_type == $request->reactionType) {
                $reaction->delete();
            } elseif ($reaction && $reaction->reaction_type !== $request->reactionType) {
                $reaction->update(['reaction_type' => $request->reactionType]);
            } else {
                $reaction = Reaction::create([
                    'reaction_type' => $request->reactionType,
                    'comment_id' => $request->commentId,
                    'visitor_id' => $request->visitorId,
                ]);
            }

            Event::dispatch('backend.reaction.created', [$reaction->id]);

            return $reaction->id;
        });
    }

    public function delete(DeleteBackendReactionDto $request): void
    {
        DB::transaction(static function () use ($request): void {
            $reaction = Reaction::findOrFail($request->id);
            $reaction->delete();

            Event::dispatch('backend.reaction.deleted', [$reaction->id]);
        });
    }
}
