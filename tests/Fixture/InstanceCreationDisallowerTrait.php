<?php

namespace Keradus\Traits\Tests\Fixture;

class InstanceCreationDisallowerTrait
{
    use \Keradus\Traits\InstanceCreationDisallowerTrait;

    public static function createInstance()
    {
        return new static();
    }
}
