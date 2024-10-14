<?php

use Illuminate\Support\Facades\Route;
use Modules\Backend\Reaction\Http\Actions\ViewBackendReactionAction;
use Modules\Backend\Reaction\Http\Actions\QueryBackendReactionAction;
use Modules\Backend\Reaction\Http\Actions\CreateBackendReactionAction;
use Modules\Backend\Reaction\Http\Actions\DeleteBackendReactionAction;

Route::name('backend.reaction')->prefix('backend/reaction')->middleware(['api', 'visitor'])->group(function () {
    Route::name('query')->get('/', QueryBackendReactionAction::class);
    Route::name('create')->post('/', CreateBackendReactionAction::class);

    Route::prefix('{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::name('view')->get('/', ViewBackendReactionAction::class);
        Route::name('delete')->delete('/', DeleteBackendReactionAction::class);
    });
});
