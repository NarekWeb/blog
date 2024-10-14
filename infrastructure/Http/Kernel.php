<?php

namespace Infrastructure\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Infrastructure\Http\Middlewares\PreventRequestsDuringMaintenance;
use Infrastructure\Http\Middlewares\TrimStrings;
use Infrastructure\Http\Middlewares\TrustProxies;
use Infrastructure\Http\Middlewares\VisitorIdentification;

/**
 * @codeCoverageIgnore
 */
final class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        HandleCors::class,
        TrimStrings::class,
        TrustProxies::class,
        ValidatePostSize::class,
        PreventRequestsDuringMaintenance::class,
        ConvertEmptyStringsToNull::class,
        VisitorIdentification::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'api' => [
            VisitorIdentification::class,
            SubstituteBindings::class,
        ],
        'frontend' => [
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'visitor' => VisitorIdentification::class,
        'throttle' => ThrottleRequests::class,
    ];
}
