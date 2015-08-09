<?php

namespace PhpDDD\Utils\Tests;

use Exception;
use PhpDDD\Utils\ClassUtils;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 *
 */
final class ClassUtilsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getCanonicalNameProvider
     *
     * @param string|object $class
     * @param string        $expected
     */
    public function testGetCanonicalName($class, $expected)
    {
        $this->assertTrue(true);
        $this->assertEquals($expected, ClassUtils::getCanonicalName($class));
        $this->assertEquals($expected, ClassUtils::getCanonicalName(ClassUtils::getCanonicalName($class)));
    }

    /**
     * @dataProvider getCanonicalNameProviderException
     *
     * @param mixed  $class
     * @param string $parameterType
     */
    public function testGetCanonicalNameException($class, $parameterType)
    {
        try {
            ClassUtils::getCanonicalName($class);
            $this->assertFalse(true, 'An exception should have been thrown.');
        } catch (Exception $exception) {
            $this->assertEquals(
                'The class parameter should be of type string or object, "'.$parameterType.'" given.',
                $exception->getMessage()
            );
        }
    }

    /**
     * @dataProvider getShortNameProvider
     *
     * @param mixed  $class
     * @param string $expectedShortName
     */
    public function testGetShortName($class, $expectedShortName)
    {
        $this->assertEquals($expectedShortName, ClassUtils::getShortName($class));
    }

    public function getCanonicalNameProvider()
    {
        return array(
            array(new self(), 'php_ddd.utils.tests.class_utils_test'),
            array(new stdClass(), 'std_class'),
            array('MyNamespace\\Sub\\FooBar', 'my_namespace.sub.foo_bar'),
            array(null, null),
        );
    }

    public function getCanonicalNameProviderException()
    {
        return array(
            array(5, 'integer'),
            array(5.55, 'double'),
            array(array(), 'array'),
        );
    }

    public function getShortNameProvider()
    {
        return array(
            array(new self(), 'ClassUtilsTest'),
            array(new stdClass(), 'stdClass'),
            array('stdClass', 'stdClass'),
            array('MyNamespace\\Sub\\FooBar', 'FooBar'),
        );
    }
}
