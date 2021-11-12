<?php

namespace Zbxin\CaseJson\Middleware;

use Closure;
use Illuminate\Http\Request;
use Zbxin\CaseJson\ConvertJsonKeyFormat;
use Zbxin\Contracts\MiddlewareExceptRoute;

class CaseInputJson extends MiddlewareExceptRoute
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function subHandle($request, Closure $next)
    {
        if (!empty($request->input())) {
            $request->replace(ConvertJsonKeyFormat::convertJsonKeyFormat(json_encode($request->input()), config('tools.case_input_format'), true));
        }
        return $next($request);
    }
}
