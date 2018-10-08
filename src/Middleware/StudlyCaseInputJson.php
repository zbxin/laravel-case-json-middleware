<?php

namespace ZhiEq\Middleware;

use Closure;
use Illuminate\Http\Request;
use ZhiEq\CaseJson\ConvertJsonKeyFormat;
use ZhiEq\Contracts\MiddlewareExceptRoute;

class StudlyCaseInputJson extends MiddlewareExceptRoute
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function subHandle($request, Closure $next)
    {
        if (!empty($request->getContent())) {
            $request->replace(ConvertJsonKeyFormat::convertJsonKeyFormat($request->getContent(), ConvertJsonKeyFormat::FORMAT_STUDLY_CASE, true));
        }
        return $next($request);
    }
}
