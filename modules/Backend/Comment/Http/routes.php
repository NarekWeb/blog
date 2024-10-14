<?php

use Illuminate\Support\Facades\Route;
use Modules\Backend\Comment\Http\Actions\ViewBackendCommentAction;
use Modules\Backend\Comment\Http\Actions\QueryBackendCommentAction;
use Modules\Backend\Comment\Http\Actions\CreateBackendCommentAction;
use Modules\Backend\Comment\Http\Actions\DeleteBackendCommentAction;
use Modules\Backend\Comment\Http\Actions\UpdateBackendCommentAction;

Route::name('backend.comment')->prefix('backend/comment')->middleware(['api', 'visitor'])->group(function () {
    Route::name('query')->get('/', QueryBackendCommentAction::class);
    Route::name('create')->post('/', CreateBackendCommentAction::class);

    Route::prefix('{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::name('view')->get('/', ViewBackendCommentAction::class);
        Route::name('update')->put('/', UpdateBackendCommentAction::class);
        Route::name('delete')->delete('/', DeleteBackendCommentAction::class);
    });
});
