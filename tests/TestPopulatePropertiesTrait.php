<?php

namespace PhpDDD\Utils;

final class TestPopulatePropertiesTrait
{
    use PopulatePropertiesTrait;

    public $testPublic;

    protected $testProtected;

    private $testPrivate;

    /**
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->populate($data);
    }

    /**
     * @return mixed
     */
    public function getTestPrivate()
    {
        return $this->testPrivate;
    }

    /**
     * @return mixed
     */
    public function getTestProtected()
    {
        return $this->testProtected;
    }

    /**
     * @return mixed
     */
    public function getTestPublic()
    {
        return $this->testPublic;
    }
}
