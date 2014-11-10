<?php

namespace Keradus\Traits;

/**
 * Trait, that adds functionality of inner class cache.
 *
 * @example
 *  class Foo
 *  {
 *      use InnerClassCacheTrait;
 *
 *      public function square($x)
 *      {
 *          if (!isset($this->cache[$x])) {
 *              $this->cache[$x] = $x * $x;
 *          }
 *
 *          return $this->cache[$x];
 *      }
 *  }
 */
trait InnerClassCacheTrait
{
    /**
     * Cache container.
     *
     * @type array
     */
    protected $cache = [];

    /**
     * Clear cache.
     */
    public function clearCache()
    {
        $this->cache = [];
    }
}
