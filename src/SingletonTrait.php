<?php

namespace Keradus\Ker\Traits;

trait SingletonTrait
{
    /**
     * Create Singleton instance.
     *
     * @return Singleton instance
     */
    public static function getInstance()
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * Prevent creating Singleton instance by "new" keyword.
     */
    protected function __construct()
    {
        // TODO: what about parameters?
    }

    /**
     * Prevent cloning Singleton instance.
     */
    protected function __clone()
    {
    }

    /**
     * Prevent unserializing Singleton instance.
     */
    protected function __wakeup()
    {
    }
}
