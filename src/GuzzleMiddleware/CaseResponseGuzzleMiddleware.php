<?php

namespace Zbxin\CaseJson\GuzzleMiddleware;

use GuzzleHttp\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zbxin\CaseJson\ConvertJsonKeyFormat;

class CaseResponseGuzzleMiddleware
{

    protected $caseType;

    public function __construct($caseType = ConvertJsonKeyFormat::FORMAT_CAMEL_CASE)
    {
        $this->caseType = $caseType;
    }

    /**
     * @param callable $handler
     * @return \Closure
     */

    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            /**
             * @var Promise $promise
             */
            $promise = $handler($request, $options);
            return $promise->then(
                function (ResponseInterface $response) {
                    $content = $response->getBody()->getContents();
                    if (!empty($content)) {
                        $response = $response->withBody(\GuzzleHttp\Psr7\stream_for(ConvertJsonKeyFormat::convertJsonKeyFormat($content, $this->caseType)));
                    }
                    return $response;
                }
            );
        };
    }
}
