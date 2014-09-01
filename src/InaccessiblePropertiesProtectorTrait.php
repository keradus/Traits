<?php

namespace Keradus\Ker\Traits;

/**
 * Inaccessible properties protector.
 *
 * Trait, that protects accessing inaccessible (unknown) properties to help keeping code clean and safe.
 *
 * @example
 *  class Foo
 *  {
 *      public $baz;
 *  }
 *
 *  $foo = new Foo();
 *  $foo->vaz = 123; // PHP claims that code is OK, even if you misspelled variable name!
 *
 *  class Bar
 *  {
 *      use InaccessiblePropertiesProtectorTrait;
 *      public $baz;
 *  }
 *
 *  $bar = new Bar();
 *  $bar->vaz = 123; // now PHP throws \LogicException
 */
trait InaccessiblePropertiesProtectorTrait
{
    /**
     * Protect checking if inaccessible property is set.
     *
     * @param string $_name property name
     */
    public function __isset($_name)
    {
        throw new \LogicException(sprintf("Cannot check unexisting property %s->%s", __CLASS__, $_name));
    }

    /**
     * Protect getting inaccessible property.
     *
     * @param string $_name property name
     */
    public function __get($_name)
    {
        throw new \LogicException(sprintf("Cannot get unexisting property %s->%s", __CLASS__, $_name));
    }

    /**
     * Protect setting inaccessible property.
     *
     * @param string $_name  property name
     * @param mixed  $_value property value
     */
    public function __set($_name, $_value)
    {
        throw new \LogicException(sprintf("Cannot set unexisting property %s->%s = %s", __CLASS__, $_name, var_export($_value, true)));
    }
}
