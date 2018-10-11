<?php

namespace ZhiEq\CaseJson\Middleware;

use Closure;
use Illuminate\Http\Request;
use ZhiEq\CaseJson\ConvertJsonKeyFormat;
use ZhiEq\Contracts\MiddlewareExceptRoute;

class CaseInputJson extends MiddlewareExceptRoute
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function subHandle($request, Closure $next)
    {
        if (!empty($request->getContent())) {
            $request->replace(ConvertJsonKeyFormat::convertJsonKeyFormat($request->getContent(), config('tools.case_input_format'), true));
        }
        return $next($request);
    }
}
