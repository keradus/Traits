<?php

namespace Keradus\Traits\Tests\PHPUnit;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function getFixtureName()
    {
        return str_replace("Keradus\\Traits\\Tests\\Test\\", "Keradus\\Traits\\Tests\\Fixture\\", get_called_class());
    }

    public function createFixtureInstance()
    {
        $name = $this->getFixtureName();

        return new $name();
    }
}
