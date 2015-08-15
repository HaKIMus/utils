<?php

namespace PhpDDD\Utils\Tests;

use PHPUnit_Framework_TestCase;

/**
 *
 */
final class PopulatePropertiesTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param array $data
     */
    public function testPopulate($data)
    {
        $class = new TestPopulatePropertiesTrait($data);

        $this->assertEquals(isset($data['testPublic']) ? $data['testPublic'] : null, $class->getTestPublic());
        $this->assertEquals(isset($data['testProtected']) ? $data['testProtected'] : null, $class->getTestProtected());
        $this->assertEquals(isset($data['testPrivate']) ? $data['testPrivate'] : null, $class->getTestPrivate());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPopulateUnknownProperty()
    {
        new TestPopulatePropertiesTrait(['unknown' => 'test']);
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array $data
     */
    public function testSerialize($data)
    {
        $class = new TestPopulatePropertiesTrait($data);
        $result = new TestPopulatePropertiesTrait();
        $result->unserialize($class->serialize());
        $this->assertEquals($class, $result);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [[]],
            [['testPublic' => 5]],
            [['testProtected' => 6]],
            [['testPrivate' => 7]],
            [['testPublic' => 5, 'testProtected' => 6]],
            [['testPublic' => 5, 'testPrivate' => 7]],
            [['testProtected' => 6, 'testPrivate' => 7]],
            [['testPublic' => 5, 'testProtected' => 6, 'testPrivate' => 7]],
        ];
    }
}
