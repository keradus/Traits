<?php

namespace Keradus\Ker\Traits\Tests\Fixture;

class InstanceCreationDisallowerTrait
{
    use \Keradus\Ker\Traits\InstanceCreationDisallowerTrait;

    public static function createInstance()
    {
        return new static();
    }
}
