<?php

namespace Zbxin\CaseJson\Middleware;

use Closure;
use Illuminate\Http\Request;
use Zbxin\CaseJson\ConvertJsonKeyFormat;
use Zbxin\Contracts\MiddlewareExceptRoute;

class StudlyCaseInputJson extends MiddlewareExceptRoute
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function subHandle($request, Closure $next)
    {
        if (!empty($request->input())) {
            $request->replace(ConvertJsonKeyFormat::convertJsonKeyFormat(json_encode($request->input()), ConvertJsonKeyFormat::FORMAT_STUDLY_CASE, true));
        }
        return $next($request);
    }
}
