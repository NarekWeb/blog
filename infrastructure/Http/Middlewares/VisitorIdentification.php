<?php

namespace Infrastructure\Http\Middlewares;

use Closure;
use Infrastructure\Eloquent\Models\Visitor;

class VisitorIdentification
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');
        $visitorId = hash('sha256', $ip . $userAgent);

        $visitorId = Visitor::firstOrCreate(['uuid' => $visitorId])->id;
        $request->merge(['visitorId' => $visitorId]);

        return $next($request);
    }
}
