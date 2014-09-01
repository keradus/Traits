<?php

namespace Keradus\Ker\Traits\Tests\PHPUnit;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function getFixtureName()
    {
        return str_replace("Keradus\\Ker\\Traits\\Tests\\Test\\", "Keradus\\Ker\\Traits\\Tests\\Fixture\\", get_called_class());
    }

    public function createFixtureInstance()
    {
        $name = $this->getFixtureName();

        return new $name();
    }
}
