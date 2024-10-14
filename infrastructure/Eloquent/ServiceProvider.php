<?php

namespace Infrastructure\Eloquent;

use http\Env\Request;
use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\Comment ;
use Infrastructure\Eloquent\Models\Post;
use Infrastructure\Eloquent\Macros\AddGlobalScope;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Infrastructure\Eloquent\Models\Reaction;
use Infrastructure\Eloquent\Models\Visitor;

final class ServiceProvider extends BaseServiceProvider
{
    public const MORPH_MAP = [
        'visitor' => Visitor::class,
        'post' => Post::class,
        'comment' => Comment::class,
        'reaction' => Reaction::class,
        'request' => Request::class,
    ];

    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static fn($name) => 'Database\\Factories\\' . class_basename($name) . 'Factory');
        Factory::guessModelNamesUsing(static fn($name) => 'Infrastructure\\Eloquent\\Models\\' . Str::of(class_basename($name))->beforeLast('Factory'));

        Relation::enforceMorphMap(self::MORPH_MAP);

        AddGlobalScope::bind();
    }
}
