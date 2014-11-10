<?php

namespace Keradus\Traits;

/**
 * Trait, that disallow to create instance of class.
 * Use for protecting static classes (only static members).
 */
trait InstanceCreationDisallowerTrait
{
    protected function __construct()
    {
        throw new \LogicException("Class with InstanceCreationDisallowerTrait must not be initialized");
    }
}
