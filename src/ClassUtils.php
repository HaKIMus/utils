<?php

namespace PhpDDD\Utils;

use Exception;

final class ClassUtils
{
    /**
     * @param mixed $class
     *
     * @return string
     *
     * @throws Exception
     */
    public static function getCanonicalName($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        if (!is_string($class)) {
            throw new Exception(
                sprintf(
                    'The class parameter should be of type string or object, "%s" given.',
                    gettype($class)
                )
            );
        }

        $namespaces = explode('\\', $class);
        $canonical  = [];
        foreach ($namespaces as $part) {
            $canonical[] = StringUtils::toSnakeCase($part, '-');
        }

        return implode('__', $canonical);
    }
}
