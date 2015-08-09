<?php

namespace PhpDDD\Utils;

use Exception;

final class ClassUtils
{
    /**
     * @param string|object|null $class
     *
     * @return string|null
     *
     * @throws Exception
     */
    public static function getCanonicalName($class)
    {
        if (null === $class) {
            return;
        }

        $className = self::getClassFullQualifiedName($class);

        if (false !== strpos($className, '.')) {
            return $className;
        }

        return implode(
            '.',
            array_map(
                function ($namespace) {
                    return StringUtils::toSnakeCase($namespace, '_');
                },
                explode('\\', $className)
            )
        );
    }

    /**
     * @param object|string $class
     *
     * @return string
     */
    public static function getShortName($class)
    {
        $className = self::getClassFullQualifiedName($class);
        $parts     = explode('\\', $className);

        return end($parts);
    }

    /**
     * @param string $class
     *
     * @throws Exception
     */
    private static function assertString($class)
    {
        if (!is_string($class)) {
            throw new Exception(
                sprintf(
                    'The class parameter should be of type string or object, "%s" given.',
                    gettype($class)
                )
            );
        }
    }

    /**
     * @param object|string $class
     *
     * @return string
     *
     * @throws Exception
     */
    private static function getClassFullQualifiedName($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        self::assertString($class);

        return $class;
    }
}
