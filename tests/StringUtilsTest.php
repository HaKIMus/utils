<?php

namespace PhpDDDTests\Utils\Tests;

use Exception;
use PhpDDD\Utils\StringUtils;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 *
 */
final class StringUtilsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider toSnakeCaseProvider
     *
     * @param string $camelCaseString
     * @param string $snakeCaseString
     *
     * @throws \Exception
     */
    public function testToSnakeCase($camelCaseString, $snakeCaseString)
    {
        $this->assertEquals($snakeCaseString, StringUtils::toSnakeCase($camelCaseString));
    }

    /**
     * @dataProvider toSnakeCaseWithSeparatorProvider
     *
     * @param string $camelCaseString
     * @param string $snakeCaseString
     * @param string $separator
     *
     * @throws \Exception
     */
    public function testToSnakeCaseWithSeparator($camelCaseString, $snakeCaseString, $separator)
    {
        $this->assertEquals($snakeCaseString, StringUtils::toSnakeCase($camelCaseString, $separator));
    }

    /**
     * @dataProvider toSnakeCaseExceptionProvider
     *
     * @param string $camelCaseString
     *
     * @throws \Exception
     */
    public function testToSnakeCaseException($camelCaseString)
    {
        try {
            StringUtils::toSnakeCase($camelCaseString);
            $this->assertFalse(true, 'An exception should have been thrown.');
        } catch (Exception $exception) {
            $this->assertEquals('Unable to convert non string element.', $exception->getMessage());
        }
    }

    public function toSnakeCaseProvider()
    {
        return array(
            array('ClassUtils', 'class_utils'),
        );
    }

    public function toSnakeCaseWithSeparatorProvider()
    {
        return array(
            array('ClassUtils', 'class_utils', '_'),
        );
    }

    /**
     * @return array
     */
    public function toSnakeCaseExceptionProvider()
    {
        return array(
            array(5),
            array(5.55),
            array(array()),
            array(new stdClass()),
        );
    }
}
