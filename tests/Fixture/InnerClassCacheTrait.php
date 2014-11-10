<?php

namespace Keradus\Traits\Tests\Fixture;

class InnerClassCacheTrait
{
    use \Keradus\Traits\InnerClassCacheTrait;

    public function get($key)
    {
        return $this->cache[$key];
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function exists($key)
    {
        return isset($this->cache[$key]);
    }

    public function set($key, $value)
    {
        $this->cache[$key] = $value;
    }
}
