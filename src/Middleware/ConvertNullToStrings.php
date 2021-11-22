<?php


namespace App\Http\Middleware;


use Closure;
use Zbxin\CaseJson\Exceptions\JsonFormatInvalidException;
use Zbxin\Contracts\MiddlewareExceptRoute;

class ConvertNullToStrings extends MiddlewareExceptRoute
{

    public function subHandle($request, Closure $next)
    {
        $response = $next($request);
        if (!empty($response->getContent()) && !empty(json_decode($response->getContent(), true))) {
            $json = json_decode($response->getContent(), true);
            if ($json === false){
                throw new JsonFormatInvalidException();
            }
            $response->setContent(json_encode(filter_null($json)));
        }
        return $response;
    }
}
