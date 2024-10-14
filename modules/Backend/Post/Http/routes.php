<?php

use Illuminate\Support\Facades\Route;
use Modules\Backend\Post\Http\Actions\ViewBackendPostAction;
use Modules\Backend\Post\Http\Actions\QueryBackendPostAction;
use Modules\Backend\Post\Http\Actions\CreateBackendPostAction;
use Modules\Backend\Post\Http\Actions\DeleteBackendPostAction;
use Modules\Backend\Post\Http\Actions\UpdateBackendPostAction;

Route::name('backend.post')->prefix('backend/post')->middleware(['api', 'visitor'])->group(function () {
    Route::name('query')->get('/', QueryBackendPostAction::class);
    Route::name('create')->post('/', CreateBackendPostAction::class);

    Route::prefix('{id}')->where(['id' => '[0-9]+'])->group(function () {
        Route::name('view')->get('/', ViewBackendPostAction::class);
        Route::name('update')->put('/', UpdateBackendPostAction::class);
        Route::name('delete')->delete('/', DeleteBackendPostAction::class);
    });
});
