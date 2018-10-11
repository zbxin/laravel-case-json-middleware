<?php

namespace ZhiEq\CaseJson\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ZhiEq\CaseJson\ConvertJsonKeyFormat;
use ZhiEq\Contracts\MiddlewareExceptRoute;

class StudlyCaseOutputJson extends MiddlewareExceptRoute
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function subHandle($request, Closure $next)
    {
        /**
         * @var Response $response
         */
        $response = $next($request);
        if (!empty($response->getContent()) && !empty(json_decode($response->getContent(), true))) {
            $response->setContent(ConvertJsonKeyFormat::convertJsonKeyFormat($response->getContent(), ConvertJsonKeyFormat::FORMAT_STUDLY_CASE));
        }
        return $response;
    }
}
