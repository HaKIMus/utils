<?php

namespace PhpDDD\Utils;

use Exception;

final class StringUtils
{
    /**
     * @param string $camelCaseString
     * @param string $separator
     *
     * @return string
     *
     * @throws Exception
     */
    public static function toSnakeCase($camelCaseString, $separator = '_')
    {
        if (!is_string($camelCaseString)) {
            throw new Exception('Unable to convert non string element.');
        }

        preg_match_all('#([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)#', $camelCaseString, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode($separator, $ret);
    }
}
