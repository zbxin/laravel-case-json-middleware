<?php

namespace ZhiEq\CaseJson;

use ZhiEq\CaseJson\Exceptions\JsonFormatInvalidException;
use ZhiEq\CaseJson\Exceptions\JsonKeyFormatInvalidException;

class ConvertJsonKeyFormat
{
    const FORMAT_CAMEL_CASE = 'camel_case';
    const FORMAT_STUDLY_CASE = 'studly_case';
    const FORMAT_SNAKE_CASE = 'snake_case';

    /**
     * @param $json
     * @param $format
     * @param bool $returnArray
     * @return false|array|string
     */

    public static function convertJsonKeyFormat($json, $format, $returnArray = false)
    {
        $formatDefinition = [
            self::FORMAT_CAMEL_CASE,
            self::FORMAT_STUDLY_CASE,
            self::FORMAT_SNAKE_CASE,
        ];
        if (!in_array($format, $formatDefinition)) {
            throw new JsonKeyFormatInvalidException();
        }
        $json = json_decode($json, true);
        if ($json === null) {
            throw new JsonFormatInvalidException();
        }
        $convertResult = call_user_func($format . '_array_keys', $json);
        return $returnArray === true ? $convertResult : json_encode($convertResult);
    }
}
