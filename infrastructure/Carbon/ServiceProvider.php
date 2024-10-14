<?php

namespace Infrastructure\Carbon;

use Infrastructure\Carbon\Macros\TryParse;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        TryParse::bind();
    }
}
